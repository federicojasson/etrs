// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('errorManager', [ '$location', errorManagerService ]);
	
	/*
	 * Service: errorManager.
	 * 
	 * Offers functions to manage HTTP errors.
	 * This service should be used whenever is necessary to report that an error
	 * occurred communicating with the server.
	 */
	function errorManagerService($location) {
		var service = this;
		
		/*
		 * The last error that occurred.
		 */
		service.error = null;
		
		/*
		 * Reports the occurrence of an error.
		 * It receives the object representing the server response.
		 */
		service.reportError = function(response) {
			// Updates the current error
			// TODO: should a conversion be made? yes
			service.error = response;
			
			// Redirects the user to the error route
			$location.path('/error');
		};
	};
})();
