/**
 * NEU-CO - Neuro-Cognitivo
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
	angular.module('app.action.resetPassword').factory('ResetPasswordAction', [
		'inputValidator',
		'Input',
		'server',
		ResetPasswordActionFactory
	]);
	
	/**
	 * Defines the ResetPasswordAction class.
	 */
	function ResetPasswordActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		ResetPasswordAction.prototype.input;
		
		/**
		 * The not-authenticated callback.
		 */
		ResetPasswordAction.prototype.notAuthenticatedCallback;
		
		/**
		 * The start callback.
		 */
		ResetPasswordAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		ResetPasswordAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function ResetPasswordAction() {
			this.startCallback = new Function();
			this.notAuthenticatedCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				credentials: {
					id: new Input(),
					password: new Input()
				},
				
				password: new Input(function() {
					return inputValidator.isPassword(this);
				}),
				
				passwordConfirmation: new Input(function() {
					return inputValidator.isPasswordConfirmation(this.input.passwordConfirmation, this.input.password.value);
				}.bind(this))
			};
		}
		
		/**
		 * Executes the action.
		 */
		ResetPasswordAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Resets the user's password
			server.account.resetPassword({
				credentials: {
					id: this.input.credentials.id.value,
					password: this.input.credentials.password.value
				},
				
				password: this.input.password.value
			}).then(function(output) {
				if (! output.authenticated) {
					// The password-reset permission has not been authenticated
					
					// Invokes the not-authenticated callback
					this.notAuthenticatedCallback();
					
					return;
				}
				
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return ResetPasswordAction;
	}
})();
