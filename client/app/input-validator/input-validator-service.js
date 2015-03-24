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
	angular.module('app.inputValidator').service('inputValidator', inputValidatorService);
	
	/**
	 * Provides input-validation functions.
	 */
	function inputValidatorService() {
		var _this = this;
		
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
			
			if (! /(?!.*\p{Cc})(?!.* )(?!.*@.*@)^.+@.+$/.test(input.value)) {
				// The input is not an email address
				input.message = 'La dirección de correo electrónico no es válida';
				return false;
			}
			
			// The input is an email address
			input.message = '';
			return true;
		};
		
		/**
		 * Determines whether an input is a gender.
		 * 
		 * Receives the input.
		 */
		_this.isGender = function(input) {
			if (input.value === '') {
				// The input is not a gender
				input.message = 'Seleccione el sexo';
				return false;
			}
			
			// The input is a gender
			input.message = '';
			return true;
		};
		
		/**
		 * Determines whether an input is valid.
		 * 
		 * Receives the input, which can be an Input instance or an object. In
		 * the latter case, the object's properties are validated recursively.
		 */
		_this.isInputValid = function(input) {
			if (angular.isDefined(input.validate) && angular.isFunction(input.validate)) {
				// The input is an Input instance
				
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
				
				// Validates the property
				valid &= _this.isInputValid(input[property]);
			}
			
			return valid;
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
			
			// The input is a user ID
			input.message = '';
			return true;
		};
		
		/**
		 * Determines whether an input is a user role.
		 * 
		 * Receives the input.
		 */
		_this.isUserRole = function(input) {
			if (input.value === '') {
				// The input is not a user role
				input.message = 'Seleccione el rol de usuario';
				return false;
			}
			
			// The input is a user role
			input.message = '';
			return true;
		};
		
		/**
		 * Determines whether an input is a valid password.
		 * 
		 * Receives the input.
		 */
		_this.isValidPassword = function(input) {
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
			
			// The input is a valid password
			input.message = '';
			return true;
		};
		
		/**
		 * Determines whether an input is a valid password confirmation.
		 * 
		 * Receives the input and the password.
		 */
		_this.isValidPasswordConfirmation = function(input, password) {
			if (input.value !== password) {
				// The input doesn't match the password
				input.message = 'Las contraseñas ingresadas no coinciden';
				return false;
			}
			
			// The input is a valid password confirmation
			input.message = '';
			return true;
		};
		
		/**
		 * Determines whether an input is a valid string.
		 * 
		 * Receives the input, the minimum allowed length and, optionally, the
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
			
			// The input is a valid string
			input.message = '';
			return true;
		};
	}
})();
