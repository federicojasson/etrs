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
		
		/*
		 * Validates a command line.
		 * 
		 * It receives the input model.
		 */
		service.validateCommandLine = function(inputModel) {
			// Gets the input model's value
			var value = inputModel.value;
			
			if (value.length > 1024) {
				// The input is too long
				inputModel.message = 'Este campo puede tener a lo sumo 1024 caracteres';
				return false;
			}
			
			if (! /^.*( |^):input( |$).*$/.test(value)) {
				// The input doesn't have the input placeholder
				inputModel.message = 'La línea debe contener el indicador :input para el archivo de entrada';
				return false;
			}
			
			// The input is valid
			inputModel.message = '';
			return true;
		};
		
		/*
		 * Validates an email address.
		 * 
		 * It receives the input model.
		 */
		service.validateEmailAddress = function(inputModel) {
			// Gets the input model's value
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
		 * Validates a name.
		 * 
		 * It receives the input model.
		 */
		service.validateName = function(inputModel) {
			if (inputModel.value.length > 48) {
				// The input is too long
				inputModel.message = 'Este campo puede tener a lo sumo 48 caracteres';
				return false;
			}
			
			// The input is valid
			inputModel.message = '';
			return true;
		};
		
		/*
		 * Validates a password.
		 * 
		 * It receives the input model.
		 */
		service.validatePassword = function(inputModel) {
			// Gets the input model's value
			var value = inputModel.value;
			
			if (value.length < 8) {
				// The input is too short
				inputModel.message = 'La contraseña debe tener al menos 8 caracteres';
				return false;
			}
			
			if (! /^.*[a-z].*$/.test(value)) {
				// The input doesn't have a lowercase letter
				inputModel.message = 'La contraseña debe tener al menos una letra minúscula';
				return false;
			}
			
			if (! /^.*[A-Z].*$/.test(value)) {
				// The input doesn't have an uppercase letter
				inputModel.message = 'La contraseña debe tener al menos una letra mayúscula';
				return false;
			}
			
			if (! /^.*[0-9].*$/.test(value)) {
				// The input doesn't have a digit
				inputModel.message = 'La contraseña debe tener al menos un dígito';
				return false;
			}
			
			// The input is valid
			inputModel.message = '';
			return true;
		};
		
		/*
		 * Validates a password confirmation.
		 * 
		 * It receives the input model and the password with which its value
		 * must match.
		 */
		service.validatePasswordConfirmation = function(inputModel, password) {
			if (inputModel.value !== password) {
				// The passwords don't match
				inputModel.message = 'Las contraseñas ingresadas no coinciden';
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
			if (inputModel.value.length < 1) {
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
			// Gets the input model's value
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
