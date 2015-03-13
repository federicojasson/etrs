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
	angular.module('app.authentication').service('authentication', [
		'data',
		'server',
		authenticationService
	]);
	
	/**
	 * Manages the authentication state.
	 */
	function authenticationService(data, server) {
		var _this = this;
		
		/**
		 * The signed-in user.
		 */
		var signedInUser = null;
		
		/**
		 * Indicates whether the authentication state is being refreshed.
		 */
		var stateRefreshing = false;
		
		/**
		 * Returns the signed-in user.
		 */
		_this.getSignedInUser = function() {
			return signedInUser;
		};
		
		/**
		 * Determines whether the authentication state is being refreshed.
		 */
		_this.isStateRefreshing = function() {
			return stateRefreshing;
		};
		
		/**
		 * Determines whether the user is signed in.
		 */
		_this.isUserSignedIn = function() {
			return signedInUser !== null;
		};
		
		/**
		 * Refreshes the authentication state.
		 * 
		 * It should be invoked whenever the authentication state or the data of
		 * the signed-in user change, in order to keep the application
		 * synchronized with the server.
		 */
		_this.refreshState = function() {
			stateRefreshing = true;
			
			// Gets the authentication state
			server.authentication.getState().then(function(output) {
				if (! output.signedIn) {
					// The user is not signed in
					signedInUser = null;
					
					stateRefreshing = false;
					return;
				}
				
				// TODO: prepare data service?
				
				// Gets the account
				data.getAccount().then(function(account) {
					// Sets the signed-in user
					signedInUser = account;
					
					stateRefreshing = false;
				});
			});
		};
	}
})();
