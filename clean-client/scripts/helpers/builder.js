// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: builder
	module.service('builder', builderService);
	
	/*
	 * Service: builder
	 * 
	 * Offers functions to build various application objects.
	 */
	function builderService() {
		var service = this;
		
		/*
		 * The default validation function for the input models.
		 */
		var defaultValidationFunction = function() {
			return true;
		};
		
		/*
		 * Builds an input model.
		 * 
		 * It optionally receives an object containing parameters: the
		 * validation function and the initial value. This object should have
		 * the following structure:
		 * 
		 *	parameters: {
		 *		initialValue: ...,
		 *		validationFunction: ...
		 *	}
		 * 
		 * Both properties are optional.
		 */
		service.buildInputModel = function(parameters) {
			// Initializes the input model parameters with default values
			var validate = defaultValidationFunction;
			var value = '';
			
			if (angular.isDefined(parameters)) {
				// Extracts the parameters
				
				if (angular.isDefined(parameters.initialValue)) {
					value = parameters.initialValue;
				}
				
				if (angular.isDefined(parameters.validationFunction)) {
					validate = parameters.validationFunction;
				}
			}
			
			// Builds and returns the input model
			return {
				isValid: true,
				message: '',
				validate: validate,
				value: value
			};
		};
	}
})();
