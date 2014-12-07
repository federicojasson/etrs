// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: authentication
	module.service('authentication', [
		'$q',
		'data',
		'server',
		authenticationService
	]);
	
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
	function authenticationService($q, data, server) {
		var service = this;
		
		/*
		 * The deferred task.
		 */
		var deferredTask = null;
		
		/*
		 * The logged in user.
		 */
		var loggedInUser = null;
		
		/*
		 * Returns the promise of the deferred task.
		 */
		service.getDeferredTaskPromise = function() {
			return deferredTask.promise;
		};
		
		/*
		 * Returns the logged in user.
		 */
		service.getLoggedInUser = function() {
			return loggedInUser;
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
			// TODO: report error?
			
			// Initializes a deferred task
			deferredTask = $q.defer();
			
			// Gets the authentication state
			server.getAuthenticationState().then(function(output) {
				if (output.loggedIn) {
					// The user is logged in
					
					data.prepare({
						user: {
							mainData: true
						}
					});
					
					// Gets the user's data
					data.getUser(output.id).then(function(user) {
						// Sets the logged in user
						loggedInUser = user;

						// Resolves the deferred task
						deferredTask.resolve(service);
					}, function() {
						// Rejects the deferred task
						deferredTask.reject();
					});
				} else {
					// The user is not logged in
					loggedInUser = null;
					
					// Resolves the deferred task
					deferredTask.resolve(service);
				}
			}, function() {
				// Rejects the deferred task
				deferredTask.reject();
			});
		};
	}
})();
