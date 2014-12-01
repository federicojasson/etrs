// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: data
	module.service('data', [
		'$q',
		dataService
	]);
	
	/*
	 * Service: data
	 * 
	 * Offers functions to obtain data resources.
	 * 
	 * This service should be used whenever is necessary to get data from the
	 * server. It automatically sends requests and builds the proper objects.
	 * 
	 * The service also offers a cache feature, so that the data already loaded
	 * is not requested again.
	 */
	function dataService($q) {
		var service = this;
		
		/*
		 * The data cache.
		 */
		var cache;
		
		/*
		 * The fields to take into account when loading the data.
		 */
		var fields;
		
		// TODO: implement
		
		/*
		 * TODO
		 */
		service.getUser = function(userId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets the users in cache
			var users = cache.users;
			
			if (angular.isDefined(users[userId])) {
				// The user has already been loaded
				
				// Resolves the deferred task
				deferredTask.resolve(users[userId]);
			} else {
				// The user has not been loaded yet
				
				// Initializes the user
				var user = {
					id: userId
				};
				
				// Stores the user in cache
				users[userId] = user;
				
				// TODO
			}
			
			return deferredTask.promise;
		};
		
		/*
		 * Prepares the service to start fetching data. The function clears the
		 * cache and sets the fields to take into account when loading the data.
		 * 
		 * It receives the fields.
		 */
		service.prepare = function(newFields) {
			// Clears the cache
			cache = {
				consultations: [],
				experiments: [],
				files: [],
				patients: [],
				studies: [],
				users: []
			};
			
			// Sets the fields to take into account
			fields = newFields;
		};
	}
})();
