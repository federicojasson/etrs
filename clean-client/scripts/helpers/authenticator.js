// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: authenticator
	module.service('authenticator', [
		'$q',
		authenticatorService
	]);
	
	/*
	 * Service: authenticator
	 * 
	 * TODO: comments
	 */
	function authenticatorService($q) {
		var service = this;
		
		/*
		 * The deferred task.
		 */
		var deferred = null;
		
		/*
		 * Returns the promise of this service.
		 */
		service.getPromise = function() {
			return deferred.promise;
		};
		
		/*
		 * Refreshes the authentication state.
		 */
		service.refreshAuthenticationState = function() {
			// Initializes a deferred task
			deferred = $q.defer();
			
			// TODO
			deferred.resolve(service);
		};
	}
})();

