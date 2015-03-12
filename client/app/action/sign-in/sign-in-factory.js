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
	angular.module('app.action.signIn').factory('SignInAction', [
		'authentication',
		'inputValidator',
		'InputModel',
		'server',
		SignInActionFactory
	]);
	
	/**
	 * Defines the SignInAction class.
	 */
	function SignInActionFactory(authentication, inputValidator, InputModel, server) {
		/**
		 * The input.
		 */
		SignInAction.prototype.input;
		
		/**
		 * The not-authenticated callback.
		 * 
		 * It is invoked when the user is not authenticated.
		 */
		SignInAction.prototype.notAuthenticatedCallback;
		
		/**
		 * The start callback.
		 * 
		 * It is invoked at the start of the action.
		 */
		SignInAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 * 
		 * It is invoked when the action is successful.
		 */
		SignInAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function SignInAction() {
			// Initializes the callbacks
			this.notAuthenticatedCallback = function() {};
			this.startCallback = function() {};
			this.successCallback = function() {};
			
			// Defines the input
			this.input = {
				credentials: {
					id: new InputModel(function() {
						// TODO: input validation
						return true;
					}),
					
					password: new InputModel(function() {
						// TODO: input validation
						return true;
					})
				}
			};
		}
		
		/**
		 * Executes the action.
		 */
		SignInAction.prototype.execute = function() {
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
				}
			};
			
			// Signs in the user
			server.account.signIn(input).then(function(output) {
				if (! output.authenticated) {
					// The user has not been authenticated
					
					// Invokes the not-authenticated callback
					this.notAuthenticatedCallback();
					
					return;
				}
				
				// Refreshes the authentication state
				authentication.refreshState();
				
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return SignInAction;
	}
})();
