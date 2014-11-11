// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('classes');
	
	// Factories
	module.factory('Error', [
		'contentManager',
		ErrorFactory
	]);
	
	/*
	 * Factory: Error.
	 * 
	 * It represents an error.
	 */
	function ErrorFactory(contentManager) {
		/*
		 * Creates a fatal error.
		 */
		Error.createFatalError = function(details) {
			// Initializes the error data
			var message = 'Se produjo un error y la aplicación no puede continuar';
			
			// Creates and returns the error object
			return new Error(details, message);
		};
		
		/*
		 * Creates an error from a server response.
		 */
		Error.createFromServerResponse = function(response) {
			// Gets the error ID
			response = response.data.errorId;
			
			// Initializes the error data
			var details = 'Error ' + response.status;
			var message = contentManager.getError().message;
			
			// Creates and returns the error object
			return new Error(details, message);
		}
		
		/*
		 * The error details.
		 */
		Error.prototype.details = null;
		
		/*
		 * The error message.
		 */
		Error.prototype.message = null;
		
		/*
		 * Creates an instance of this class.
		 */
		function Error(details, message) {
			this.details = details;
			this.message = message;
		}
		
		/*
		 * Returns the error details.
		 */
		Error.prototype.getDetails = function() {
			return this.details;
		};
		
		/*
		 * Returns the error message.
		 */
		Error.prototype.getMessage = function() {
			return this.message;
		};
		
		// Returns the constructor function
		return Error;
	}
})();
