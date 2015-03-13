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
			if (! _this.isValidString(input, 0, 254)) {
				// The input is not a valid string
				return false;
			}
			
			if (! /(?!.*[ ])(?!.*@.*@)^.+@.+$/.test(input.value)) {
				// The input is not an email address
				input.message = 'Ingrese una dirección de correo electrónico válida';
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
			// Defines the genders
			var genders = [
				'f',
				'm'
			];
			
			if (genders.indexOf(input.value) === -1) {
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
		 * Receives the input, which can be an input model or an object. In the
		 * latter case, the properties of the object are validated recursively.
		 */
		_this.isInputValid = function(input) {
			if (angular.isDefined(input.validate) && angular.isFunction(input.validate)) {
				// It is an input model
				
				// Validates the input
				input.validate();
				
				// Determines whether the input is valid
				return input.valid;
			}
			
			// Determines whether the properties of the object are valid
			var valid = true;
			for (var property in input) { if (! input.hasOwnProperty(property)) continue;
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
				input.message = 'El nombre de usuario sólo puede contener letras, dígitos y puntos';
				return false;
			}
			
			if (/[.]{2}/g.test(input.value)) {
				// The input contains two or more consecutive dots
				input.message = 'El nombre de usuario no puede contener dos o más puntos consecutivos';
				return false;
			}
			
			if (/^[.].*$/.test(input.value)) {
				// The input starts with a dot
				input.message = 'El nombre de usuario no puede comenzar con un punto';
				return false;
			}
			
			if (/^.*[.]$/.test(input.value)) {
				// The input ends with a dot
				input.message = 'El nombre de usuario no puede finalizar con un punto';
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
			// Defines the user roles
			var userRoles = [
				'ad',
				'dr',
				'op'
			];
			
			if (userRoles.indexOf(input.value) === -1) {
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

			if (! /[0-9]/g.test(input.value)) {
				// The input doesn't contain a digit
				input.message = 'La contraseña debe contener al menos un dígito';
				return false;
			}

			if (! /[A-Z]/g.test(input.value)) {
				// The input doesn't contain an uppercase character
				input.message = 'La contraseña debe contener al menos una letra mayúscula';
				return false;
			}

			if (! /[a-z]/g.test(input.value)) {
				// The input doesn't contain a lowercase character
				input.message = 'La contraseña debe contener al menos una letra minúscula';
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
		 * maximum allowed length.
		 */
		_this.isValidString = function(input, minimumLength, maximumLength) {
			// Initializes the maximum length if is undefined
			maximumLength = (angular.isDefined(maximumLength)) ? maximumLength : input.value.length;
			
			if (input.value.length < minimumLength) {
				// The input is too short
				input.message = '';
				input.message += 'Este campo debe tener al menos ' + minimumLength + ' ';
				input.message += (minimumLength === 1) ? 'caracter' : 'caracteres';
				return false;
			}
			
			if (input.value.length > maximumLength) {
				// The input is too long
				input.message = '';
				input.message += 'Este campo puede tener a lo sumo ' + maximumLength + ' ';
				input.message += (maximumLength === 1) ? 'caracter' : 'caracteres';
				return false;
			}
			
			// The input is a valid string
			input.message = '';
			return true;
		};
	}
})();
