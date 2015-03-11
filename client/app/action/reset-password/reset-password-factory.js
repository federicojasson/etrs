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
	angular.module('app.action.resetPassword').factory('ResetPasswordAction', [
		'inputValidator',
		'InputModel',
		'server',
		ResetPasswordActionFactory
	]);
	
	/**
	 * Defines the ResetPasswordAction class.
	 */
	function ResetPasswordActionFactory(inputValidator, InputModel, server) {
		/**
		 * TODO: comment.
		 */
		ResetPasswordAction.prototype.credentials;
		
		/**
		 * The input.
		 */
		ResetPasswordAction.prototype.input;
		
		/**
		 * TODO: comment
		 */
		ResetPasswordAction.prototype.notAuthenticatedCallback;
		
		/**
		 * TODO: comment
		 */
		ResetPasswordAction.prototype.startCallback;
		
		/**
		 * TODO: comment
		 */
		ResetPasswordAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function ResetPasswordAction() {
			// TODO: comment
			this.notAuthenticatedCallback = function() {};
			this.startCallback = function() {};
			this.successCallback = function() {};
			
			// Initializes the input
			this.input = {
				password: new InputModel(function() {
					// TODO: implement validation
					return true;
				}),
				
				passwordConfirmation: new InputModel(function() {
					// TODO: implement validation
					return true;
				})
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
			
			// Defines the input to be sent to the server
			var input = {
				credentials: this.credentials,
				password: this.input.password.value
			};
			
			// Resets the user's password
			server.account.resetPassword(input).then(function(output) {
				if (! output.authenticated) {
					// The reset-permission has not been authenticated
					
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
