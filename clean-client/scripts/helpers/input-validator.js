// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
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
		 * Determines whether the length of an input is longer (or equal) than a
		 * certain minimum.
		 * 
		 * It receives the input and the minimum length.
		 */
		service.meetsMinimumLength = function(input, minimumLength) {
			return input.length >= minimumLength;
		}
		
		/*
		 * Validates a set of input models and returns the result.
		 * 
		 * It receives an object containing the input models. Note that these
		 * don't need to be immediate properties of the received object, an
		 * input model hierarchy is accepted.
		 */
		service.validate = function(inputModels) {
			// Initializes the validation result
			var result = true;
			
			// Validates the input models
			for (var property in inputModels) {
				if (inputModels.hasOwnProperty(property)) {
					// Gets the child object
					var child = inputModels[property];
					
					// Gets the validate property
					var validate = child.validate;
					
					if (angular.isDefined(validate) && validate.constructor === Function) {
						// The validate property corresponds to the input
						// model's validate function, so it invokes it
						result &= child.validate();
					} else {
						// The validate property is an object in the hierarchy,
						// so it validates it recursively
						result &= service.validate(child);
					}
				}
			}
			
			return result;
		};
	}
})();
