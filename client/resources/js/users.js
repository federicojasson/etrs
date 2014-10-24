// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('users', []);
	
	// Services
	module.service('authenticationManager', authenticationManagerService);
	
	/*
	 * Service: authenticationManager.
	 * 
	 * Offers functions to manage the logged in user.
	 * This service should be used whenever it is necessary to know if the user
	 * is logged in and which is her role. Also, the update functions (logInUser
	 * and logOutUser) must be called when the user is logged in or logged out,
	 * to keep the client application synchronized with its corresponding state
	 * in the server.
	 */
	function authenticationManagerService() {
		var service = this;
		
		/*
		 * The logged in user.
		 * If the user is not logged in, its value is null.
		 */
		service.loggedInUser = null;
		
		/*
		 * Returns the logged in user.
		 * If the user is not logged in, null is returned.
		 */
		service.getLoggedInUser = function() {
			return service.loggedInUser;
		};
		
		/*
		 * Determines whether the user is logged in.
		 */
		service.isUserLoggedIn = function() {
			return service.loggedInUser !== null;
		};
		
		/*
		 * Logs in a user.
		 */
		service.logInUser = function(user) {
			service.loggedInUser = user;
		};
		
		/*
		 * Logs out the user.
		 */
		service.logOutUser = function() {
			service.loggedInUser = null;
		};
	};
})();
