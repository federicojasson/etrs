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
	angular.module('app.action.editAccount').factory('EditAccountAction', [
		'authentication',
		'inputValidator',
		'InputModel',
		'server',
		EditAccountActionFactory
	]);
	
	/**
	 * Defines the EditAccountAction class.
	 */
	function EditAccountActionFactory(authentication, inputValidator, InputModel, server) {
		/**
		 * The input.
		 */
		EditAccountAction.prototype.input;
		
		/**
		 * The start callback.
		 * 
		 * It is invoked at the start of the action.
		 */
		EditAccountAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 * 
		 * It is invoked when the action is successful.
		 */
		EditAccountAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function EditAccountAction() {
			// Initializes the callbacks
			this.startCallback = function() {};
			this.successCallback = function() {};
			
			// Defines the input
			this.input = {
				// TODO: define
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
			
			// Defines the input to be sent to the server
			var input = {
				// TODO: define
			};
			
			// Edits the account
			server.account.edit(input).then(function() {
				// Refreshes the authentication state
				authentication.refreshState();
				
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return EditAccountAction;
	}
})();
