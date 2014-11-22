// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('helpers');
	
	// Services
	module.service('builder', [
		'contentManager',
		builderService
	]);
	
	/*
	 * Service: builder
	 * 
	 * Offers functions to build application objects.
	 */
	function builderService(contentManager) {
		var service = this;
		
		/*
		 * Builds and returns an error.
		 * 
		 * It receives the response sent by the server.
		 */
		service.buildError = function(response) {
			var errorId = response.data.errorId;
			var errorDescription = contentManager.getErrors()[errorId].description;
			
			var details = 'ID: ' + errorId + '\n\n' + 'Descripción:\n' + errorDescription;
			var message = 'Error ' + response.status;
			
			return {
				details: details,
				message: message
			};
		};
		
		/*
		 * Builds and returns a fatal error.
		 * 
		 * It receives its details.
		 */
		service.buildFatalError = function(details) {
			var message = 'Se produjo un error y la aplicación no puede continuar';
			
			return {
				details: details,
				message: message
			};
		};
		
		/*
		 * Builds and returns an input model.
		 * 
		 * It receives the validation function.
		 */
		service.buildInputModel = function(validate) {
			var isValid = true;
			var message = '';
			var value = '';
			
			return {
				isValid: isValid,
				message: message,
				validate: validate,
				value: value
			};
		};
	}
})();
