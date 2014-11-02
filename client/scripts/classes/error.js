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
			// Gets the error message and its HTTP status code
			var message = response.data; // TODO: json decode?
			var statusCode = response.status;
			
			// Creates and returns the error object
			return new Error(message, statusCode);
		};
		
		/*
		 * TODO: comments
		 */
		Error.prototype.message = null;
		
		/*
		 * TODO: comments
		 */
		Error.prototype.statusCode = null;
		
		/*
		 * Creates an instance of this class.
		 */
		function Error(message, statusCode) {
			this.message = message;
			this.statusCode = statusCode;
		}
		
		/*
		 * Returns the error message.
		 */
		Error.prototype.getMessage = function() {
			return this.message;
		};
		
		/*
		 * Returns the HTTP status code of the error.
		 */
		Error.prototype.getStatusCode = function() {
			return this.statusCode;
		};
		
		// Returns the constructor function
		return Error;
	}
})();
