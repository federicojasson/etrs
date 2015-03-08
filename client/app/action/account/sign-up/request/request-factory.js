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
	angular.module('app.action.account.signUp.request').factory('ActionAccountSignUpRequest', [
		'inputValidator',
		'InputModel',
		'server',
		ActionAccountSignUpRequestFactory
	]);
	
	/**
	 * Defines the ActionAccountSignUpRequest class.
	 */
	function ActionAccountSignUpRequestFactory(inputValidator, InputModel, server) {
		/**
		 * The input.
		 */
		ActionAccountSignUpRequest.prototype.input;
		
		/**
		 * Initializes an instance of the class.
		 */
		function ActionAccountSignUpRequest() {
			// Initializes the input
			this.input = {
				credentials: {
					password: new InputModel(function() {
						// TODO: implement
						return true;
					})
				},

				recipient: {
					name: new InputModel(function() {
						// TODO: implement
						return true;
					}),
					
					emailAddress: new InputModel(function() {
						// TODO: implement
						return true;
					})
				},

				userRole: new InputModel(function() {
					// TODO: implement
					return true;
				})
			};
		}
		
		/**
		 * Executes the action.
		 * 
		 * Receives TODO: comment
		 */
		ActionAccountSignUpRequest.prototype.execute = function(startCallback, endCallback) {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Defines the input to be sent to the server
			var input = {
				credentials: {
					password: this.input.credentials.password.value
				},

				recipient: {
					name: this.input.recipient.name.value,
					emailAddress: this.input.recipient.emailAddress.value
				},

				userRole: this.input.userRole.value
			};
			
			// Invokes the start callback
			startCallback();
			
			// Requests a sign-up permission
			server.account.signUp.request(input).then(function(output) {
				if (angular.isDefined(endCallback)) {
					// Invokes the end callback
					endCallback(output);
				}
			});
		};
		
		// ---------------------------------------------------------------------
		
		// Returns the class
		return ActionAccountSignUpRequest;
	}
})();
