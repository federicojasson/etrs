// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('classes');
	
	// Factories
	module.factory('Error', ErrorFactory);
	
	/*
	 * Factory: Error.
	 * 
	 * Error class.
	 * It represents a HTTP error.
	 */
	function ErrorFactory() {
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
		 * The error code
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
		 * Returns the error code.
		 */
		Error.prototype.getCode = function() {
			return this.code;
		};
		
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
			return messages[this.code];
		};
		
		var messages = {
			// TODO: testing
			ERROR_TESTING: 'Mensaje de prueba'
		};
		
		// Returns the constructor function
		return Error;
	}
})();
