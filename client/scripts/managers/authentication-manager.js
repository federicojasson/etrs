// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: managers
	var module = angular.module('managers');
	
	// Service: authenticationManager
	module.service('authenticationManager', [
		'$q',
		'server',
		authenticationManagerService
	]);
	
	/*
	 * Service: authenticationManager
	 * 
	 * Offers functions to manage the authentication state.
	 * 
	 * This service should be used whenever is necessary to know if the user is
	 * logged in and her information. Also, the refreshAuthenticationState
	 * function must be called when the user is logged in or logged out, to keep
	 * the client application synchronized with its corresponding state in the
	 * server.
	 */
	function authenticationManagerService($q, server) {
		var service = this;
		
		/*
		 * The deferred object used to asynchronously refresh the authentication
		 * state.
		 */
		var deferred = null;
		
		/*
		 * The logged in user.
		 */
		var loggedInUser = null;
		
		/*
		 * Returns the logged in user.
		 */
		service.getLoggedInUser = function() {
			return loggedInUser;
		};
		
		/*
		 * Returns the promise.
		 */
		service.getPromise = function() {
			return deferred.promise;
		};
		
		/*
		 * Determines whether the user is logged in.
		 */
		service.isUserLoggedIn = function() {
			return loggedInUser !== null;
		};
		
		/*
		 * Refreshes the authentication state.
		 */
		service.refreshAuthenticationState = function() {
			// Initializes the deferred object
			deferred = $q.defer();
			
			// Gets the authentication state
			server.getAuthenticationState().then(function(response) {
				if (response.loggedIn) {
					// The user is logged in
					var userId = response.user.data.id;
					
					// Gets the user's data
					server.getUserData(userId).then(function(response) {
						// Sets the logged in user
						loggedInUser = response.user;

						// Resolves the deferred
						deferred.resolve(service);
					}, function() {
						// Rejects the deferred
						deferred.reject();
					});
				} else {
					// The user is not logged in
					loggedInUser = null;
					
					// Resolves the deferred
					deferred.resolve(service);
				}
			}, function() {
				// Rejects the deferred
				deferred.reject();
			});
		};
	}
})();
