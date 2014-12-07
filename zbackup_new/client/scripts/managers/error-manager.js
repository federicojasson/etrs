// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: managers
	var module = angular.module('managers');
	
	// Service: errorManager
	module.service('errorManager', [
		'$location',
		errorManagerService
	]);
	
	/*
	 * Service: errorManager
	 * 
	 * Offers functions to manage errors.
	 * 
	 * This service should be used whenever is necessary to report the
	 * occurrence of an error.
	 * 
	 * The service distinguishes between two types of errors:
	 * 
	 * - Regular error: the application can recover from this error.
	 * - Fatal error: the application can not continue executing.
	 */
	function errorManagerService($location) {
		var service = this;
		
		/*
		 * The error that occurred.
		 */
		var occurredError = null;
		
		/*
		 * Determines whether an error occurred.
		 */
		service.errorOccurred = function() {
			return occurredError !== null;
		};
		
		/*
		 * Returns the occurred error.
		 */
		service.getOccurredError = function() {
			return occurredError;
		};
		
		/*
		 * Reports the occurrence of a regular error.
		 * 
		 * It receives the object representing the error.
		 */
		service.reportError = function(error) {
			// Sets the occurred error
			occurredError = error;
			
			// Redirects the user to the error route
			$location.path('/error');
		};
		
		/*
		 * Reports the occurrence of a fatal error.
		 * 
		 * It receives the object representing the error.
		 */
		service.reportFatalError = function(error) {
			// Sets the occurred error
			occurredError = error;
			
			// Redirects the user to the fatal error route
			$location.path('/fatal-error');
		};
	}
})();
