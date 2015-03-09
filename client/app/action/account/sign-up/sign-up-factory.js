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
	angular.module('app.action.account.signUp').factory('ActionAccountSignUp', [
		'inputValidator',
		'InputModel',
		'server',
		ActionAccountSignUpFactory
	]);
	
	/**
	 * Defines the ActionAccountSignUp class.
	 */
	function ActionAccountSignUpFactory(inputValidator, InputModel, server) {
		/**
		 * The credentials of the sign-up permission.
		 */
		ActionAccountSignUp.prototype.credentials;

		/**
		 * The input.
		 */
		ActionAccountSignUp.prototype.input;
		
		/**
		 * Initializes an instance of the class.
		 * 
		 * Receives the credentials of the sign-up permission.
		 */
		function ActionAccountSignUp(credentials) {
			// Sets the credentials
			this.credentials = credentials;
			
			// Initializes the input
			this.input = {
				id: new InputModel(function() {
					// TODO: input validation
					return true;
				}),
				
				password: new InputModel(function() {
					// TODO: input validation
					return true;
				}),
				
				passwordConfirmation: new InputModel(function() {
					// TODO: input validation
					return true;
				}),
				
				emailAddress: new InputModel(function() {
					// TODO: input validation
					return true;
				}),
				
				firstName: new InputModel(function() {
					// TODO: input validation
					return true;
				}),
				
				lastName: new InputModel(function() {
					// TODO: input validation
					return true;
				}),
				
				gender: new InputModel(function() {
					// TODO: input validation
					return true;
				})
			};
		}
		
		/**
		 * Executes the action.
		 * 
		 * Receives a callback to be invoked at the start of the execution, and
		 * another to be invoked at the end.
		 */
		ActionAccountSignUp.prototype.execute = function(startCallback, endCallback) {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// TODO: check if user exists
			
			// Defines the input to be sent to the server
			var input = {
				credentials: this.credentials,
				id: this.input.id.value,
				password: this.input.password.value,
				emailAddress: this.input.emailAddress.value,
				firstName: this.input.firstName.value,
				lastName: this.input.lastName.value,
				gender: this.input.gender.value
			};
			
			// Invokes the start callback
			startCallback();
			
			// Signs up the user
			server.account.signUp(input).then(function(output) {
				if (angular.isDefined(endCallback)) {
					// Invokes the end callback
					endCallback(output);
				}
			});
		};
		
		// ---------------------------------------------------------------------
		
		// Returns the class
		return ActionAccountSignUp;
	}
})();
