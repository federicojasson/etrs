// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('authenticationManager', [
		'$q',
		'User',
		'server',
		authenticationManagerService
	]);
	
	/*
	 * Service: authenticationManager.
	 * 
	 * Offers functions to manage the authentication state.
	 * 
	 * This service should be used whenever is necessary to know if the user is
	 * logged in and her information. Also, the refreshAuthenticationState
	 * function must be called when the user is logged in or logged out, to keep
	 * the client application synchronized with its corresponding state in the
	 * server.
	 */
	function authenticationManagerService($q, User, server) {
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
					
					// Gets the user's data
					server.getUser(response.userId).then(function(response) {
						// Creates and sets the logged in user
						loggedInUser = User.createFromDataObject(response.user);

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
