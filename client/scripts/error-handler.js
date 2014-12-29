// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: errorHandler
	var module = angular.module('errorHandler', [
		'app'
	]);
	
	// Controller: ErrorHandlerController
	module.controller('ErrorHandlerController', [
		'errorHandler',
		ErrorHandlerController
	]);
	
	// Service: errorHandler
	module.service('errorHandler', errorHandlerService);
	
	/*
	 * Controller: ErrorHandlerController
	 * 
	 * Offers functions to access the error handler service.
	 */
	function ErrorHandlerController(errorHandler) {
		var controller = this;
		
		/*
		 * Returns the occurred error.
		 */
		controller.getError = function() {
			return errorHandler.getError();
		};
	}
	
	/*
	 * Service: errorHandler
	 * 
	 * Offers functions to handle errors.
	 * 
	 * This service should be used whenever is necessary to report the
	 * occurrence of an error.
	 */
	function errorHandlerService() {
		var service = this;
		
		/*
		 * The error.
		 */
		var error = null;
		
		/*
		 * Determines whether an error occurred.
		 */
		service.errorOccurred = function() {
			return error !== null;
		};
		
		/*
		 * Returns the occurred error.
		 */
		service.getError = function() {
			return error;
		};
		
		/*
		 * Reports an error.
		 * 
		 * It receives the error.
		 */
		service.reportError = function(newError) {
			error = newError;
		};
	}
})();
