// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('authenticationManager', [
		'$q',
		'$timeout',
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
	function authenticationManagerService($q, $timeout, server) {
		var service = this;
		
		/*
		 * Returns the logged in user.
		 * 
		 * If the user is not logged in, null is returned.
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
			$timeout(function() {
				// TODO
				deferred.reject();
			}, 2000);
			
			// Sends a request to the server
			/*server.user.getAuthenticationState().then(function(response) {
				// TODO
			}, function(response) {
				// TODO: reject promise
			});*/
		};
		
		/*
		 * The deferred object used to asynchronously refresh the authentication
		 * state.
		 */
		var deferred = $q.defer();
		
		/*
		 * The logged in user.
		 */
		var loggedInUser = null;
	}
})();
