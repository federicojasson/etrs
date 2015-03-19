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
	angular.module('app.layout.site').controller('SiteLayoutController', [
		'$controller',
		'$scope',
		'account',
		'SignOutAction',
		SiteLayoutController
	]);
	
	/**
	 * Represents the site layout.
	 */
	function SiteLayoutController($controller, $scope, account, SignOutAction) {
		var _this = this;
		
		/**
		 * Indicates whether the layout is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/layout/site/site.html';
		};
		
		/**
		 * Returns the title to set when the layout is ready.
		 */
		_this.getTitle = function() {
			return '';
		};
		
		/**
		 * Determines whether the layout is ready.
		 */
		_this.isReady = function() {
			if (account.isBeingRefreshed()) {
				// The account is being refreshed
				return false;
			}
			
			return ready;
		};
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes the necessary controllers
			$scope.account = $controller('AccountController');
			
			// Initializes the sign-out action
			var signOutAction = new SignOutAction();
			signOutAction.startCallback = onSignOutStart;
			signOutAction.successCallback = onSignOutSuccess;
			
			// Includes the actions
			$scope.signOutAction = signOutAction;
		}
		
		/**
		 * Invoked at the start of the sign-out action.
		 */
		function onSignOutStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the sign-out action is successful.
		 */
		function onSignOutSuccess() {
			ready = true;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
