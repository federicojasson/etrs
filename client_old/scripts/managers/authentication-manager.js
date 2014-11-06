// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('authenticationManager', [
		'User',
		'errorManager',
		'server',
		authenticationManagerService
	]);
	
	/*
	 * Service: authenticationManager.
	 * 
	 * Offers functions to manage the authentication state.
	 * This service should be used whenever is necessary to know if the user is
	 * logged in and her information. Also, the refresh function must be called
	 * when the user is logged in or logged out, to keep the client application
	 * synchronized with its corresponding state in the server.
	 */
	function authenticationManagerService(User, errorManager, server) {
		var service = this;
		
		/*
		 * Indicates whether a request was sent to the server to refresh the
		 * authentication state.
		 */
		service.isRefreshing = false; // TODO: dudoso: usar metodo?
		
		/*
		 * The logged in user.
		 * If the user is not logged in, its value is null.
		 */
		service.loggedInUser = null; // TODO: dudoso: usar metodo?
		
		/*
		 * Determines whether the user is logged in.
		 */
		service.isUserLoggedIn = function() {
			return service.loggedInUser !== null;
		};
		
		/*
		 * Refreshes the authentication state, sending a request to the server.
		 */
		service.refresh = function() {
			// The refresh process begins
			service.isRefreshing = true;
			
			/*
			 * Reports the error to the error manager.
			 */
			var onFailure = function(response) {
				// Reports the error
				errorManager.reportError(response);
				
				// The refresh process is over
				service.isRefreshing = false;
			};
			
			/*
			 * If the user is logged in, it updates its information.
			 * Otherwise, it nullifies it.
			 */
			var onSuccess = function(response) {
				if (response.loggedIn) {
					// The user is logged in
					service.updateLoggedInUser(response.userId);
				} else {
					// The user is not logged in
					service.loggedInUser = null;
					
					// The refresh process is over
					service.isRefreshing = false;
				}
			};
			
			var callbacks = {
				onFailure: onFailure,
				onSuccess: onSuccess
			};
			
			// Sends a request to the server
			server.user.getAuthenticationState(callbacks);
		};
		
		/*
		 * Updates the information about the logged in user, sending a request
		 * to the server.
		 */
		service.updateLoggedInUser = function(userId) {
			/*
			 * Reports the error to the error manager.
			 */
			var onFailure = function(response) {
				// Reports the error
				errorManager.reportError(response);
				
				// The refresh process is over
				service.isRefreshing = false;
			};
			
			/*
			 * Set the information about the logged in user.
			 */
			var onSuccess = function(response) {
				// Sets the logged in user
				service.loggedInUser = User.createFromDataObject(response.user);
				
				// The refresh process is over
				service.isRefreshing = false;
			};

			var callbacks = {
				onFailure: onFailure,
				onSuccess: onSuccess
			};

			// Sends a request to the server
			server.user.getUser(userId, callbacks);
		};
		
		// Gets the authentication state
		service.refresh();
	}
})();
