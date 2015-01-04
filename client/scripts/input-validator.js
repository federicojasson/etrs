// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: inputValidator
	var module = angular.module('inputValidator', [
		'app'
	]);
	
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
		 * Validates an email address.
		 * 
		 * It receives the input model.
		 */
		service.validateEmailAddress = function(inputModel) {
			var value = inputModel.value;
			
			if (value.length > 254) {
				// The input is too long
				inputModel.message = 'Este campo puede tener a lo sumo 254 caracteres';
				return false;
			}
			
			if (! /(?!.*[ ])(?!.*@.*@)^.+@.+$/.test(value)) {
				// The input is not a valid email address
				inputModel.message = 'La dirección de correo electrónico ingresada no es válida';
				return false;
			}
			
			// The input is valid
			inputModel.message = '';
			return true;
		};
		
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
					
					if (angular.isDefined(child.validateInput) && angular.isFunction(child.validateInput)) {
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
		 * TODO: comments
		 */
		service.validateQuery = function(inputModel) {
			if (inputModel.value.length > 160) {
				// The input is too long
				inputModel.message = 'Este campo puede tener a lo sumo 160 caracteres';
				return false;
			}
			
			// The input is valid
			inputModel.message = '';
			return true;
		};
		
		/*
		 * Validates a required input.
		 * 
		 * It receives the input model.
		 */
		service.validateRequiredInput = function(inputModel) {
			if (inputModel.value.length === 0) {
				// The input was not entered
				inputModel.message = 'Este campo es obligatorio';
				return false;
			}
			
			// The input is valid
			inputModel.message = '';
			return true;
		};
		
		/*
		 * Validates a user ID.
		 * 
		 * It receives the input model.
		 */
		service.validateUserId = function(inputModel) {
			var value = inputModel.value;
			
			if (value.length > 32) {
				// The input is too long
				inputModel.message = 'Este campo puede tener a lo sumo 32 caracteres';
				return false;
			}
			
			if (! /^[.0-9A-Za-z]*$/.test(value)) {
				// The input contains invalid characters
				inputModel.message = 'El ID puede contener únicamente letras, dígitos y puntos';
				return false;
			}
			
			if (/^.*[.]{2}.*$/.test(value)) {
				// The input has two or more consecutive dots
				inputModel.message = 'El ID no puede contener dos o más puntos consecutivos';
				return false;
			}
			
			if (/^[.].*$/.test(value)) {
				// The input starts with a dot
				inputModel.message = 'El ID no puede contener un punto al comienzo';
				return false;
			}
			
			if (/^.*[.]$/.test(value)) {
				// The input ends with a dot
				inputModel.message = 'El ID no puede contener un punto al final';
				return false;
			}
			
			// The input is valid
			inputModel.message = '';
			return true;
		};
	}
})();
