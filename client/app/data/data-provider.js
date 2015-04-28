/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.data').provider('data', dataProvider);
	
	/**
	 * Responsible for initializing the data service.
	 */
	function dataProvider() {
		var _this = this;
		
		/**
		 * The registered types.
		 */
		var types = {};
		
		/**
		 * Returns the data service.
		 */
		_this.$get = [
			'$injector',
			'$q',
			'server',
			'utility',
			function($injector, $q, server, utility) {
				// Initializes the data service
				var data = new dataService($injector, $q, server, utility);
				
				// Adds the types
				for (var type in types) {
					if (! types.hasOwnProperty(type)) {
						continue;
					}
					
					data.addType(type, types[type]);
				}
				
				return data;
			}
		];
		
		/**
		 * Registers a type.
		 * 
		 * Receives the type and its unserializer.
		 */
		_this.registerType = function(type, unserializer) {
			types[type] = unserializer;
		};
	}
	
	/**
	 * Provides data-related functionalities.
	 */
	function dataService($injector, $q, server, utility) {
		var _this = this;
		
		/**
		 * The associations.
		 * 
		 * When loading an entity, it determines which references must be
		 * expanded.
		 */
		var associations = {};
		
		/**
		 * The cache.
		 */
		var cache = {};
		
		/**
		 * The maximum depth.
		 * 
		 * It determines how many levels of references have to be expanded. A
		 * 0-value indicates that no references must be expanded. A negative
		 * value indicates no depth limit.
		 */
		var maximumDepth = 0;
		
		/**
		 * The types.
		 */
		var types = {};
		
		/**
		 * Adds a type.
		 * 
		 * Receives the type and its unserializer.
		 */
		_this.addType = function(type, unserializer) {
			cache[type] = [];
			types[type] = unserializer;
			
			// Creates getters for the type
			
			_this['get' + type] = function(id) {
				return getEntity(type, id, 0);
			};
			
			_this['get' + type + 'Array'] = function(ids) {
				return getEntities(type, ids, 0);
			};
		};
		
		/**
		 * Gets a reference.
		 * 
		 * Receives the type, the type of the reference, the field, the entity's
		 * ID and the current depth.
		 */
		_this.getReference = function(type, referenceType, field, id, depth) {
			// Increases the depth
			depth++;
			
			var promise;
			if (depth > maximumDepth || id === null || ! expandReference(type, field)) {
				// The reference must not be expanded
				promise = id;
			} else {
				// The reference must be expanded
				// Gets the entity
				promise = getEntity(referenceType, id, depth);
			}
			
			return $q.when(promise);
		};
		
		/**
		 * Gets a set of references.
		 * 
		 * Receives the type, the type of the references, the field, the
		 * entities' IDs and the current depth.
		 */
		_this.getReferences = function(type, referencesType, field, ids, depth) {
			// Gets the references
			var promises = [];
			for (var i = 0; i < ids.length; i++) {
				promises[i] = _this.getReference(type, referencesType, field, ids[i], depth);
			}
			
			return $q.all(promises);
		};
		
		/**
		 * Resets the service.
		 * 
		 * Receives, optionally, the maximum depth and the associations to be
		 * set.
		 */
		_this.reset = function(newMaximumDepth, newAssociations) {
			// Resets the cache
			cache = {};
			for (var type in types) {
				if (! types.hasOwnProperty(type)) {
					continue;
				}
				
				cache[type] = {};
			}
			
			// Initializes the maximum depth if is undefined
			newMaximumDepth = (angular.isDefined(newMaximumDepth))? newMaximumDepth : 0;
			
			// Sets the maximum depth
			maximumDepth = newMaximumDepth;
			
			// Initializes the associations if are undefined
			newAssociations = (angular.isDefined(newAssociations))? newAssociations : {};
			
			// Sets the associations
			associations = newAssociations;
		};
		
		/**
		 * Determines whether a reference must be expanded.
		 * 
		 * Receives the type and the field.
		 */
		function expandReference(type, field) {
			if (! associations.hasOwnProperty(type)) {
				// The type must not be expanded
				return false;
			}
			
			if (utility.searchInArray(field, associations[type]) === -1) {
				// The field must not be expanded
				return false;
			}
			
			return true;
		}
		
		/**
		 * Gets a set of entities.
		 * 
		 * Receives the type, the entities' IDs and the current depth.
		 */
		function getEntities(type, ids, depth) {
			// Gets the entities
			var promises = [];
			for (var i = 0; i < ids.length; i++) {
				promises[i] = getEntity(type, ids[i], depth);
			}
			
			return $q.all(promises);
		}
		
		/**
		 * Gets an entity.
		 * 
		 * It searches the entity in the cache before loading it to avoid
		 * unnecessary queries to the server.
		 * 
		 * Receives the type, the entity's ID and the current depth.
		 */
		function getEntity(type, id, depth) {
			if (angular.isUndefined(cache[type][id])) {
				// The entity has not been loaded yet
				// Loads the entity
				cache[type][id] = loadEntity(type, id, depth);
			}
			
			// Gets the promise of the entity stored in the cache
			return cache[type][id];
		}
		
		/**
		 * Loads an entity.
		 * 
		 * Receives the type, the entity's ID and the current depth.
		 */
		function loadEntity(type, id, depth) {
			// Gets the entity
			return server[utility.pascalToCamelCase(type)].get({
				id: id
			}).then(function(output) {
				// Gets the unserializer
				var unserializer = $injector.invoke(types[type]);
				
				// Unserializes the entity
				return unserializer(output, depth);
			});
		}
	}
})();
