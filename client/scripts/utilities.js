// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: utilities
	var module = angular.module('utilities', []);
	
	// Service: utilities
	module.service('utilities', utilitiesService);
	
	/*
	 * Service: utilities
	 * 
	 * Offers miscellaneous utility functions.
	 */
	function utilitiesService() {
		var service = this;
		
		/*
		 * TODO: remove if not used
		 * 
		 * Merges two objects and returns the result. The properties of a source
		 * object are copied into a target object.
		 * 
		 * It receives the source and target objects.
		 */
		service.mergeObjects = function(source, target) {
			for (var property in source) {
				if (source[property].constructor === Object) {
					// The property is an object
					
					if (angular.isUndefined(target[property]) || target[property].constructor !== Object) {
						// The property is undefined in the target object or is
						// not an object: it initializes it
						target[property] = {};
					}
					
					// Merges the child objects recursively
					target[property] = service.mergeObjects(source[property], target[property]);
				} else {
					// The property is not an object
					target[property] = source[property];
				}
			}
			
			return target;
		};
	}
})();
