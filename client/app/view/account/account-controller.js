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
	angular.module('app.view.account').controller('AccountViewController', [
		'data',
		'fullNameFilter',
		AccountViewController
	]);
	
	/**
	 * Represents the account view.
	 */
	function AccountViewController(data, fullNameFilter) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * The signed-in user.
		 */
		var signedInUser = null;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/account/account.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return fullNameFilter(signedInUser);
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Resets the data service
			data.reset([
				'User'
			]);
			
			// Gets the signed-in user
			data.getSignedInUser().then(function(loadedUser) {
				// Sets the signed-in user
				signedInUser = loadedUser;
				
				ready = true;
			});
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
