// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('errorManager', [
		'$location',
		'Error',
		errorManagerService
	]);
	
	/*
	 * Service: errorManager.
	 * 
	 * Offers functions to manage HTTP errors.
	 * This service should be used whenever is necessary to report that an error
	 * occurred communicating with the server.
	 */
	function errorManagerService($location, Error) {
		var service = this;
		
		/*
		 * The error that occurred.
		 */
		service.error = null; // TODO: dudoso: usar metodo?
		
		/*
		 * Determines whether an error occurred.
		 */
		service.errorOccurred = function() {
			return service.error !== null;
		};
		
		/*
		 * Reports the occurrence of an error.
		 * It receives the object representing the server response.
		 */
		service.reportError = function(response) {
			// Updates the current error
			service.error = Error.createFromServerResponse(response);
			
			// Redirects the user to the error view
			$location.path('/error');
		};
	}
})();
