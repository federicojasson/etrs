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
	angular.module('app.action.account.resetPassword.request').factory('ActionAccountResetPasswordRequest', [
		'inputValidator',
		'InputModel',
		'server',
		ActionAccountResetPasswordRequestFactory
	]);
	
	/**
	 * Defines the ActionAccountResetPasswordRequest class.
	 */
	function ActionAccountResetPasswordRequestFactory(inputValidator, InputModel, server) {
		/**
		 * The input.
		 */
		ActionAccountResetPasswordRequest.prototype.input;
		
		/**
		 * Initializes an instance of the class.
		 */
		function ActionAccountResetPasswordRequest() {
			// Initializes the input
			this.input = {
				credentials: {
					id: new InputModel(function() {
						// TODO: implement
						return true;
					}),
					
					emailAddress: new InputModel(function() {
						// TODO: implement
						return true;
					})
				}
			};
		}
		
		/**
		 * Executes the action.
		 * 
		 * Receives TODO: comment
		 */
		ActionAccountResetPasswordRequest.prototype.execute = function(startCallback, endCallback) {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Defines the input to be sent to the server
			var input = {
				credentials: {
					id: this.input.credentials.id.value,
					emailAddress: this.input.credentials.emailAddress.value
				}
			};
			
			// Invokes the start callback
			startCallback();
			
			// Requests the reset-password permission
			server.account.resetPassword.request(input).then(function(output) {
				if (angular.isDefined(endCallback)) {
					// Invokes the end callback
					endCallback(output);
				}
			});
		};
		
		// ---------------------------------------------------------------------
		
		// Returns the class
		return ActionAccountResetPasswordRequest;
	}
})();
