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
	angular.module('app.account').service('account', [
		'data',
		'server',
		accountService
	]);
	
	/**
	 * Manages the account.
	 */
	function accountService(data, server) {
		var _this = this;
		
		/**
		 * Indicates whether the account is being refreshed.
		 */
		var beingRefreshed = false;
		
		/**
		 * The signed-in user.
		 */
		var signedInUser = null;
		
		/**
		 * Returns the signed-in user.
		 */
		_this.getSignedInUser = function() {
			return signedInUser;
		};
		
		/**
		 * Determines whether the account is being refreshed.
		 */
		_this.isBeingRefreshed = function() {
			return beingRefreshed;
		};
		
		/**
		 * Determines whether the user is signed in.
		 */
		_this.isUserSignedIn = function() {
			return signedInUser !== null;
		};
		
		/**
		 * Refreshes the account.
		 * 
		 * It should be invoked whenever the user is signed in, signed out or
		 * edited, in order to keep the application synchronized with the
		 * server.
		 */
		_this.refresh = function() {
			beingRefreshed = true;
			
			// Determines whether the user is signed in
			server.account.signedIn().then(function(output) {
				if (! output.signedIn) {
					// The user is not signed in
					signedInUser = null;
					
					beingRefreshed = false;
					return;
				}
				
				// Resets the data service
				data.reset([
					'User'
				]);
				
				// Gets the user
				data.getUser(output.id).then(function(loadedUser) {
					// Sets the signed-in user
					signedInUser = loadedUser;
					
					beingRefreshed = false;
				});
			});
		};
	}
})();
