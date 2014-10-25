// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('users', [ 'communications' ]);
	
	// Services
	module.service('authenticationManager', [ 'server', authenticationManagerService ]);
	
	/*
	 * Service: authenticationManager.
	 * 
	 * Offers functions to manage the authentication state.
	 * This service should be used whenever it is necessary to know if the user
	 * is logged in and her information. Also, the refresh function must be
	 * called when the user is logged in or logged out, to keep the client
	 * application synchronized with its corresponding state in the server.
	 */
	function authenticationManagerService(server) {
		var service = this;
		
		/*
		 * Indicates whether a request was sent to the server to refresh the
		 * authentication state.
		 */
		service.isRefreshing = false; 
		
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
		 * Determines whether the authentication state is being refreshed.
		 */
		service.isBeingRefreshed = function() {
			return service.isRefreshing;
		}
		
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
			// A refreshing has begun
			service.isRefreshing = true;
			
			/*
			 * If the user is logged in, it updates its information.
			 * Otherwise, it nullifies it.
			 */
			var onSuccess = function(output) {
				if (output.loggedIn) {
					// The user is logged in
					service.loggedInUser = output.user;
				} else {
					// The user is not logged in
					service.loggedInUser = null;
				}
				
				// The refreshing is over
				service.isRefreshing = false;
			};
			
			/*
			 * TODO: onFailure comments
			 */
			var onFailure = function(output) {
				// TODO: onFailure
				
				// The refreshing is over
				service.isRefreshing = false;
			};
			
			var callbacks = {
				onSuccess: onSuccess,
				onFailure: onFailure
			};
			
			// Sends a request to the server
			server.anonymous.getAuthenticationState(callbacks);
		};
		
		// Gets the authentication state
		service.refresh();
	};
})();
