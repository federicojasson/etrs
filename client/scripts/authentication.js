// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: authentication
	var module = angular.module('authentication', [
		'data',
		'server'
	]);
	
	// Run
	module.run([
		'authentication',
		run
	]);
	
	// Service: authentication
	module.service('authentication', [
		'data',
		'server',
		authenticationService
	]);
	
	/*
	 * Performs module initialization tasks.
	 */
	function run(authentication) {
		// Refreshes the authentication state
		authentication.refreshState();
	}
	
	/*
	 * Service: authentication
	 * 
	 * Offers functions to manage the authentication state.
	 * 
	 * This service should be used whenever is necessary to know if the user is
	 * logged in and her information. Also, the refreshState function must be
	 * called when the user is logged in or logged out, in order to keep the
	 * client application synchronized with its corresponding state in the
	 * server.
	 */
	function authenticationService(data, server) {
		var service = this;
		
		/*
		 * Indicates whether the authentication state is being refreshed.
		 */
		var isRefreshingState = false;
		
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
		 * Determines whether the service is ready to be used.
		 */
		service.isReady = function() {
			return ! isRefreshingState;
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
		service.refreshState = function() {
			isRefreshingState = true;
			
			// Gets the authentication state
			server.getAuthenticationState().then(function(output) {
				if (output.loggedIn) {
					// The user is logged in
					
					// Prepares the data service
					data.prepare({
						user: {
							mainData: true
						}
					});
					
					// Gets the user's data
					data.getUser(output.id).then(function(user) {
						// Sets the logged in user
						loggedInUser = user;
						
						// The refresh process is over
						isRefreshingState = false;
					}, function(response) {
						// TODO: handle error
					});
				} else {
					// The user is not logged in
					loggedInUser = null;
					
					// The refresh process is over
					isRefreshingState = false;
				}
			}, function(response) {
				// TODO: handle error
			});
			
			// TODO: return promise instead?
		};
	}
})();
