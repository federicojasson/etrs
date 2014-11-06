// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('authenticationManager', [
		'$q',
		authenticationManagerService
	]);
	
	/*
	 * Service: authenticationManager.
	 * 
	 * Offers functions to manage the authentication state.
	 * 
	 * This service should be used whenever is necessary to know if the user is
	 * logged in and her information. Also, the refresh function must be called
	 * when the user is logged in or logged out, to keep the client application
	 * synchronized with its corresponding state in the server.
	 */
	function authenticationManagerService($q) {
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
		 * Returns this manager when it's ready. In other words, it returns a
		 * promise.
		 */
		service.getWhenReady = function() {
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
			// TODO
		};
		
		/*
		 * The deferred object used to refresh asynchronously the authentication
		 * state.
		 */
		var deferred = $q.defer();
		
		/*
		 * The logged in user.
		 */
		var loggedInUser = null;
	}
})();
