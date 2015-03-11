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
	angular.module('app.action.requestResetPassword').factory('RequestResetPasswordAction', [
		'inputValidator',
		'InputModel',
		'server',
		RequestResetPasswordActionFactory
	]);
	
	/**
	 * Defines the RequestResetPasswordAction class.
	 */
	function RequestResetPasswordActionFactory(inputValidator, InputModel, server) {
		/**
		 * The input.
		 */
		RequestResetPasswordAction.prototype.input;
		
		/**
		 * TODO: comment
		 */
		RequestResetPasswordAction.prototype.notAuthenticatedCallback;
		
		/**
		 * TODO: comment
		 */
		RequestResetPasswordAction.prototype.startCallback;
		
		/**
		 * TODO: comment
		 */
		RequestResetPasswordAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function RequestResetPasswordAction() {
			// TODO: comment
			this.notAuthenticatedCallback = function() {};
			this.startCallback = function() {};
			this.successCallback = function() {};
			
			// Initializes the input
			this.input = {
				credentials: {
					id: new InputModel(function() {
						// TODO: implement validation
						return true;
					}),
					
					emailAddress: new InputModel(function() {
						// TODO: implement validation
						return true;
					})
				}
			};
		}
		
		/**
		 * Executes the action.
		 */
		RequestResetPasswordAction.prototype.execute = function() {
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
					emailAddress: this.input.credentials.emailAddress.value
				}
			};
			
			// Requests the reset-password permission
			server.account.resetPassword.request(input).then(function(output) {
				if (! output.authenticated) {
					// The user has not been authenticated
					
					// Invokes the not-authenticated callback
					this.notAuthenticatedCallback();
					
					return;
				}
				
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		/**
		 * TODO: comment
		 */
		RequestResetPasswordAction.prototype.registerNotAuthenticatedCallback = function(callback) {
			this.notAuthenticatedCallback = callback;
		};
		
		/**
		 * TODO: comment
		 */
		RequestResetPasswordAction.prototype.registerStartCallback = function(callback) {
			this.startCallback = callback;
		};
		
		/**
		 * TODO: comment
		 */
		RequestResetPasswordAction.prototype.registerSuccessCallback = function(callback) {
			this.successCallback = callback;
		};
		
		// ---------------------------------------------------------------------
		
		return RequestResetPasswordAction;
	}
})();
