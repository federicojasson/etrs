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
	 * Error class.
	 * It represents a HTTP error.
	 */
	function ErrorFactory(contentManager) {
		/*
		 * Creates an error object from a server response.
		 */
		Error.createFromServerResponse = function(response) {
			// Gets the error code and its HTTP status code
			var code = response.data.errorCode;
			var httpStatusCode = response.status;
			
			// Creates and returns the error object
			return new Error(code, httpStatusCode);
		};
		
		/*
		 * The error code.
		 */
		Error.prototype.code = null;
		
		/*
		 * The HTTP status code of the error.
		 */
		Error.prototype.httpStatusCode = null;
		
		/*
		 * Creates an instance of this class.
		 */
		function Error(code, httpStatusCode) {
			this.code = code;
			this.httpStatusCode = httpStatusCode;
		}
		
		/*
		 * Returns the HTTP status code of the error.
		 */
		Error.prototype.getHttpStatusCode = function() {
			return this.httpStatusCode;
		};
		
		/*
		 * Returns the error message.
		 */
		Error.prototype.getMessage = function() {
			// Gets the error's predefined information
			var error = contentManager.getError(this.code);
			
			return error.message;
		};
		
		// Returns the constructor function
		return Error;
	}
})();
