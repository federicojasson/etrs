// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: builder
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
			var id = response.data.errorId;
			var description = contentManager.getErrors()[id].description;
			
			var details = 'ID: ' + id + '\n\n' + 'Descripción:\n' + description;
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
		service.buildFatalError = function(description) {
			var details = 'Descripción:\n' + description;
			var message = 'Error fatal';
			
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
