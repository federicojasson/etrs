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
		'server',
		ActionAccountResetPasswordRequestFactory
	]);
	
	/**
	 * Defines the ActionAccountResetPasswordRequest class.
	 */
	function ActionAccountResetPasswordRequestFactory(server) {
		/**
		 * The input.
		 */
		ActionAccountResetPasswordRequest.prototype.input = {
			credentials: {
				id: '',
				emailAddress: ''
			}
		};
		
		/**
		 * Initializes an instance of the class.
		 */
		function ActionAccountResetPasswordRequest() {}
		
		/**
		 * Executes the action.
		 */
		ActionAccountResetPasswordRequest.prototype.execute = function() {
			// TODO: input validation
			
			// Requests a reset-password permission
			server.account.resetPassword.request(this.input).then(function(output) {
				if (output.authenticated) {
					// The user has been authenticated
					// TODO: do something if the user is authenticated (maybe show dialog?)
				}
				
				// TODO: do something if the user is not authenticated
			});
		};
		
		// ---------------------------------------------------------------------
		
		// Returns the class
		return ActionAccountResetPasswordRequest;
	}
})();
