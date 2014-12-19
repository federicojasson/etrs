// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: inputValidator
	var module = angular.module('inputValidator', []);
	
	// Service: inputValidator
	module.service('inputValidator', inputValidatorService);
	
	/*
	 * Service: inputValidator
	 * 
	 * Offers functions to assist in the input validation.
	 */
	function inputValidatorService() {
		var service = this;
		
		/*
		 * Validates a set of input models and returns the result.
		 * 
		 * It receives an object containing the input models. Note that these
		 * don't need to be immediate properties of the received object, an
		 * input model hierarchy is accepted.
		 */
		service.validateInputModels = function(inputModels) {
			// Initializes the validation result
			var areValid = true;
			
			// Validates the input models
			for (var property in inputModels) {
				if (inputModels.hasOwnProperty(property)) {
					// Gets the child object
					var child = inputModels[property];
					
					if (angular.isDefined(child.validateInput) && child.validateInput.constructor === Function) {
						// The validateInput property corresponds to the input
						// model's validateInput function, so it invokes it
						areValid &= child.validateInput();
					} else {
						// The validateInput property is an object in the
						// hierarchy, so it validates it recursively
						areValid &= service.validateInputModels(child);
					}
				}
			}
			
			return areValid;
		};
		
		/*
		 * Validates a required input.
		 * 
		 * It receives the input model.
		 */
		service.validateRequiredInput = function(inputModel) {
			if (inputModel.value.length < 1) {
				// The input was not entered
				inputModel.message = 'Este campo es obligatorio';
				return false;
			}
			
			// The input is valid
			inputModel.message = '';
			return true;
		};
		
		// TODO: implement
	}
})();
