/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.inputValidator').service('inputValidator', [
		'DataTypeInput',
		inputValidatorService
	]);
	
	/**
	 * Provides input-validation functions.
	 */
	function inputValidatorService(DataTypeInput) {
		var _this = this;
		
		/**
		 * Determines whether an input is a command line.
		 * 
		 * Receives the input.
		 */
		_this.isCommandLine = function(input) {
			if (! _this.isValidString(input, 1, 512)) {
				// The input is not a valid string
				return false;
			}
			
			if (input.value.indexOf(':input') === -1) {
				// The input doesn't contain the "input" placeholder
				input.message = 'La línea de comandos debe contener el marcador :input';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a data-type definition.
		 * 
		 * Receives the input.
		 */
		_this.isDataTypeDefinition = function(input) {
			if (! _this.isValidString(input, 1, 1024)) {
				// The input is not a valid string
				return false;
			}
			
			try {
				// Creates a data-type input
				DataTypeInput.create(input.value);
				
				return true;
			} catch (exception) {
				// The input is an invalid data-type definition
				input.message = 'La definición del tipo de dato no es válida';
				return false;
			}
		};
		
		/**
		 * Determines whether an input is a date.
		 * 
		 * Receives the input.
		 */
		_this.isDate = function(input) {
			if (input.value === '') {
				// The date has not been selected
				input.message = 'Seleccione una fecha';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is an email address.
		 * 
		 * Receives the input.
		 */
		_this.isEmailAddress = function(input) {
			if (! _this.isValidString(input, 1, 254)) {
				// The input is not a valid string
				return false;
			}
			
			if (! /(?!.*[\u0000-\u001f])(?!.* )(?!.*@.*@)^.+@.+$/.test(input.value)) {
				// The input is an invalid email address
				input.message = 'La dirección de correo electrónico no es válida';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is an experiment.
		 * 
		 * Receives the input.
		 */
		_this.isExperiment = function(input) {
			if (input.value === '') {
				// The experiment has not been selected
				input.message = 'Seleccione un experimento';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a file.
		 * 
		 * Receives the input.
		 */
		_this.isFile = function(input) {
			if (input.value === '') {
				// The file has not been selected
				input.message = 'Seleccione un archivo';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a file name.
		 * 
		 * Receives the input.
		 */
		_this.isFileName = function(input) {
			if (! _this.isValidString(input, 1, 128)) {
				// The input is not a valid string
				return false;
			}
			
			if (/["*\/:<>?\\|]/.test(input.value)) {
				// The input contains forbidden characters
				input.message = 'El nombre del archivo no puede contener ninguno de los siguientes caracteres: " * \ / : < > ? \\ |';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a gender.
		 * 
		 * Receives the input.
		 */
		_this.isGender = function(input) {
			if (input.value === '') {
				// The gender has not been selected
				input.message = 'Seleccione un sexo';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is valid.
		 * 
		 * Receives the input, which can be an Input instance or an object. In
		 * the latter case, the object's properties are validated recursively.
		 */
		_this.isInputValid = function(input) {
			if (isInputInstance(input)) {
				// The input is an Input instance
				
				// Resets the input's message
				input.message = '';
				
				// Validates the input
				input.validate();
				
				// Determines whether the input is valid
				return input.valid;
			}
			
			// Validates the object's properties
			var valid = true;
			for (var property in input) {
				if (! input.hasOwnProperty(property)) {
					continue;
				}
				
				valid &= _this.isInputValid(input[property]);
			}
			
			return valid;
		};
		
		/**
		 * Determines whether an input is an option.
		 * 
		 * Receives the input.
		 */
		_this.isOption = function(input) {
			if (input.value === null) {
				// The option has not been selected
				input.message = 'Seleccione una opción';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a password.
		 * 
		 * Receives the input.
		 */
		_this.isPassword = function(input) {
			if (! _this.isValidString(input, 8)) {
				// The input is not a valid string
				return false;
			}
			
			if (! /[0-9]/.test(input.value)) {
				// The input doesn't contain any digit
				input.message = 'La contraseña debe tener al menos un dígito';
				return false;
			}
			
			if (! /[A-Z]/.test(input.value)) {
				// The input doesn't contain any uppercase character
				input.message = 'La contraseña debe tener al menos una letra mayúscula';
				return false;
			}
			
			if (! /[a-z]/.test(input.value)) {
				// The input doesn't contain any lowercase character
				input.message = 'La contraseña debe tener al menos una letra minúscula';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a password confirmation.
		 * 
		 * Receives the input and the password.
		 */
		_this.isPasswordConfirmation = function(input, password) {
			if (input.value !== password) {
				// The input doesn't match the password
				input.message = 'Las contraseñas ingresadas no coinciden';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a user ID.
		 * 
		 * Receives the input.
		 */
		_this.isUserId = function(input) {
			if (! _this.isValidString(input, 3, 32)) {
				// The input is not a valid string
				return false;
			}
			
			if (! /^[.0-9A-Za-z]*$/.test(input.value)) {
				// The input contains invalid characters
				input.message = 'El nombre de usuario sólo puede tener letras, dígitos y puntos';
				return false;
			}
			
			if (/\.{2}/.test(input.value)) {
				// The input contains consecutive dots
				input.message = 'El nombre de usuario no puede tener puntos consecutivos';
				return false;
			}
			
			if (/^\..*$/.test(input.value)) {
				// The input starts with a dot
				input.message = 'El nombre de usuario no puede comenzar con un punto';
				return false;
			}
			
			if (/^.*\.$/.test(input.value)) {
				// The input ends with a dot
				input.message = 'El nombre de usuario no puede terminar con un punto';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a user role.
		 * 
		 * Receives the input.
		 */
		_this.isUserRole = function(input) {
			if (input.value === '') {
				// The user role has not been selected
				input.message = 'Seleccione un rol de usuario';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a valid integer.
		 * 
		 * Receives the input, the minimum value allowed and, optionally, the
		 * maximum.
		 */
		_this.isValidInteger = function(input, minimumValue, maximumValue) {
			if (input.value === '') {
				// The input is empty
				input.message = 'Este campo es obligatorio';
				return false;
			}
			
			if (isNaN(input.value)) {
				// The input is not a number
				input.message = 'Ingrese un valor numérico';
				return false;
			}
			
			if (input.value < minimumValue) {
				// The input is too low
				input.message = 'El valor de este campo debe ser mayor o igual que ' + minimumValue;
				return false;
			}
			
			// Initializes the maximum value if is undefined
			maximumValue = (angular.isDefined(maximumValue))? maximumValue : input.value;
			
			if (input.value > maximumValue) {
				// The input is too great
				input.message = 'El valor de este campo debe ser menor o igual que ' + maximumValue;
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is a valid string.
		 * 
		 * Receives the input, the minimum length allowed and, optionally, the
		 * maximum.
		 */
		_this.isValidString = function(input, minimumLength, maximumLength) {
			// Gets the input's length
			var length = input.value.length;
			
			if (length < minimumLength) {
				// The input is too short
				
				if (length === 0) {
					// The input is empty
					input.message = 'Este campo es obligatorio';
				} else {
					// The input is not empty
					input.message = 'Este campo debe tener al menos ' + minimumLength + ' caracteres';
				}
				
				return false;
			}
			
			// Initializes the maximum length if is undefined
			maximumLength = (angular.isDefined(maximumLength))? maximumLength : length;
			
			if (length > maximumLength) {
				// The input is too long
				input.message = '';
				input.message += 'Este campo puede tener a lo sumo ' + maximumLength + ' ';
				input.message += (maximumLength === 1)? 'caracter' : 'caracteres';
				return false;
			}
			
			return true;
		};
		
		/**
		 * Determines whether an input is an Input instance.
		 * 
		 * Receives the input.
		 */
		function isInputInstance(input) {
			if (angular.isUndefined(input.validate)) {
				// The input doesn't have a validate property
				return false;
			}
			
			if (! angular.isFunction(input.validate)) {
				// The validate property is not a function
				return false;
			}
			
			return true;
		}
	}
})();
