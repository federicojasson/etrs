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
	angular.module('app.action.editAccount').factory('EditAccountAction', [
		'inputValidator',
		'Input',
		'server',
		EditAccountActionFactory
	]);
	
	/**
	 * Defines the EditAccountAction class.
	 */
	function EditAccountActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		EditAccountAction.prototype.input;
		
		/**
		 * The not-authenticated callback.
		 */
		EditAccountAction.prototype.notAuthenticatedCallback;
		
		/**
		 * The start callback.
		 */
		EditAccountAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		EditAccountAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function EditAccountAction() {
			this.startCallback = new Function();
			this.notAuthenticatedCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				credentials: {
					password: new Input(function() {
						return inputValidator.isValidString(this, 1);
					})
				},
				
				emailAddress: new Input(function() {
					return inputValidator.isEmailAddress(this);
				}),
				
				firstName: new Input(function() {
					return inputValidator.isValidString(this, 1, 48);
				}),
				
				lastName: new Input(function() {
					return inputValidator.isValidString(this, 1, 48);
				}),
				
				gender: new Input(function() {
					return inputValidator.isGender(this);
				})
			};
		}
		
		/**
		 * Executes the action.
		 */
		EditAccountAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Edits the account
			server.account.edit({
				credentials: {
					password: this.input.credentials.password.value
				},
				
				emailAddress: this.input.emailAddress.value,
				firstName: this.input.firstName.value,
				lastName: this.input.lastName.value,
				gender: this.input.gender.value
			}).then(function(output) {
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
		
		// ---------------------------------------------------------------------
		
		return EditAccountAction;
	}
})();
