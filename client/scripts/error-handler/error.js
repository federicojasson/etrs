// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: errorHandler
	var module = angular.module('errorHandler');
	
	// Factory: Error
	module.factory('Error', ErrorFactory);
	
	/*
	 * Factory: Error
	 * 
	 * TODO: comments
	 */
	function ErrorFactory() {
		/*
		 * Creates an instance of this class.
		 * 
		 * TODO: comments
		 */
		function Error(message, details) {
			this.message = message;
			this.details = details;
		}
		
		/*
		 * TODO: comments
		 */
		Error.createFromResponse = function(response) {
			// TODO: implement
			var message = 'mensaje';
			var details = 'detalles';
			
			return new Error(message, details);
		};
		
		/*
		 * TODO: comments
		 */
		Error.prototype.message;
		
		/*
		 * TODO: comments
		 */
		Error.prototype.details;
		
		return Error;
	}
})();
