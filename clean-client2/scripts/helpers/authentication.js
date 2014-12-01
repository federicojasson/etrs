// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: authentication
	module.service('authentication', [
		'$q',
		'resources',
		'server',
		authenticationService
	]);
	
	/*
	 * Service: authentication
	 * 
	 * TODO: comments
	 */
	function authenticationService($q, resources, server) {
		var service = this;
		
		/*
		 * The deferred task.
		 */
		var deferred = null;
		
		/*
		 * The logged in user.
		 */
		var loggedInUser = null;
		
		/*
		 * TODO
		 */
		service.getLoggedInUser = function() {
			return loggedInUser;
		};
		
		/*
		 * Returns the promise of this service.
		 */
		service.getPromise = function() {
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.isUserLoggedIn = function() {
			return loggedInUser !== null;
		};
		
		/*
		 * Refreshes the authentication.
		 */
		service.refresh = function() {
			// Initializes a deferred task
			deferred = $q.defer();
			
			// Gets the authentication
			server.getAuthentication().then(function(response) {
				if (response.loggedIn) {
					// The user is logged in
					
					// Gets the user's data
					var userId = response.userId;
					var fields = {
						user: {
							mainData: true
						}
					};
					
					resources.getUser(userId, fields).then(function(user) {
						// Sets the logged in user
						loggedInUser = user;

						// Resolves the deferred
						deferred.resolve(service);
					}, function() {
						// Rejects the deferred task
						deferred.reject();
					});
				} else {
					// The user is not logged in
					loggedInUser = null;
					
					// Resolves the deferred task
					deferred.resolve(service);
				}
			}, function() {
				// Rejects the deferred task
				deferred.reject();
			});
		};
	}
})();
