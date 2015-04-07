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
		 * When loading an entity, it determines what references must be loaded
		 * as well.
		 */
		var associations = {};
		
		/**
		 * The cache.
		 */
		var cache = {};
		
		/**
		 * TODO: comment
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
			// TODO: comment here?
			cache[type] = [];
			
			// TODO: comment here? necessary?
			types[type] = unserializer;
			
			// TODO: comment
			_this['get' + type] = function(id) {
				// TODO
				return getEntity(type, id, 0);
			};
		};
		
		/**
		 * TODO: comment
		 */
		_this.getAssociation = function(type0, type1, field, id, depth) { // TODO: rename types
			// TODO: comments
			
			var deferredTask = $q.defer();
			
			if (id === null) {
				deferredTask.resolve(null);
				return deferredTask.promise;
			}
			
			if (depth > maximumDepth) {
				deferredTask.resolve(id);
				return deferredTask.promise;
			}
			
			if (! associations.hasOwnProperty(type0) || associations[type0].indexOf(field) === -1) {
				deferredTask.resolve(id);
				return deferredTask.promise;
			}
			
			return getEntity(type1, id, depth);
		};
		
		/**
		 * Resets the service.
		 * 
		 * Receives, optionally, the associations to be set.
		 * TODO: comment
		 */
		_this.reset = function(newAssociations, newMaximumDepth) {
			// Initializes the associations if are undefined
			newAssociations = (angular.isDefined(newAssociations))? newAssociations : {};
			
			// Initializes the maximum depth if is undefined
			newMaximumDepth = (angular.isDefined(newMaximumDepth))? newMaximumDepth : 0;
			
			// Sets the associations
			associations = newAssociations;
			
			// Sets the maximum depth
			maximumDepth = newMaximumDepth;
			
			// Resets the cache
			cache = {};
			for (var type in types) {
				if (! types.hasOwnProperty(type)) {
					continue;
				}

				cache[type] = {};
			}
		};
		
		/**
		 * Gets an entity.
		 * 
		 * It searches the entity in the cache before loading it to avoid
		 * unnecessary queries to the server.
		 * 
		 * Receives the type and the entity's ID.
		 * TODO: comment
		 */
		function getEntity(type, id, depth) {
			// TODO: comments
			
			var deferredTask = $q.defer();
			
			var cachedEntity = cache[type][id]; // TODO: rename
			
			if (angular.isDefined(cachedEntity)) {
				console.log('cache hit: ' + type + ' - ' + id);
				return cachedEntity;
			}
			
			depth++;
			
			var promise = loadEntity(type, id, depth);
			
			// TODO: comment
			cache[type][id] = promise;
			
			promise.then(function(entity) {
				deferredTask.resolve(entity);
			});
			
			return deferredTask.promise;
		}
		
		/**
		 * Loads an entity.
		 * 
		 * Receives the type and the entity's ID.
		 * TODO: comment
		 */
		function loadEntity(type, id, depth) {
			// TODO: comment?
			var deferredTask = $q.defer();
			
			console.log('loading ' + type + ' - ' + id);
			
			// Gets the entity
			server[utility.pascalToCamelCase(type)].get({
				id: id
			}).then(function(output) {
				// Unserializes the entity
				return $injector.invoke(types[type])(output, depth);
			}).then(function(entity) {
				// TODO: comment?
				deferredTask.resolve(entity);
			});
			
			// TODO: comment?
			return deferredTask.promise;
		}
	}
})();
