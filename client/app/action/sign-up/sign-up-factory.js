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
	angular.module('app.action.signUp').factory('SignUpAction', [
		'inputValidator',
		'InputModel',
		'server',
		SignUpActionFactory
	]);
	
	/**
	 * Defines the SignUpAction class.
	 */
	function SignUpActionFactory(inputValidator, InputModel, server) {
		/**
		 * The input.
		 */
		SignUpAction.prototype.input;
		
		/**
		 * The not-authenticated callback.
		 * 
		 * It is invoked when the sign-up permission is not authenticated.
		 */
		SignUpAction.prototype.notAuthenticatedCallback;
		
		/**
		 * The not-available callback.
		 * 
		 * It is invoked when the user ID is not available.
		 */
		SignUpAction.prototype.notAvailableCallback;
		
		/**
		 * The start callback.
		 * 
		 * It is invoked at the start of the action.
		 */
		SignUpAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 * 
		 * It is invoked when the action is successful.
		 */
		SignUpAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function SignUpAction() {
			// Initializes the callbacks
			this.notAuthenticatedCallback = function() {};
			this.notAvailableCallback = function() {};
			this.startCallback = function() {};
			this.successCallback = function() {};
			
			// Defines the input
			this.input = {
				credentials: {
					id: new InputModel(),
					password: new InputModel()
				},
				
				id: new InputModel(function() {
					// TODO: input validation
					return true;
				}),
				
				emailAddress: new InputModel(function() {
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
		 */
		SignUpAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Defines the input to be sent to the server
			var input = {
				credentials: {
					id: this.input.credentials.id.value,
					password: this.input.credentials.password.value
				},
				
				id: this.input.id.value,
				emailAddress: this.input.emailAddress.value,
				password: this.input.password.value,
				firstName: this.input.firstName.value,
				lastName: this.input.lastName.value,
				gender: this.input.gender.value
			};
			
			// Signs up the user
			server.account.signUp(input).then(function(output) {
				if (! output.authenticated) {
					// The sign-up permission has not been authenticated
					
					// Invokes the not-authenticated callback
					this.notAuthenticatedCallback();
					
					return;
				}
				
				if (! output.available) {
					// The user ID is not available
					
					// Invokes the not-available callback
					this.notAvailableCallback();
					
					return;
				}
				
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return SignUpAction;
	}
})();
