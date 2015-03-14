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
	angular.module('app.navigationBar').provider('navigationBar', navigationBarProvider);
	
	/**
	 * Responsible for initializing the navigation-bar service.
	 */
	function navigationBarProvider() {
		var _this = this;
		
		/**
		 * The registered menus, organized by user role.
		 */
		var menus = {
			ad: [],
			dr: [],
			op: []
		};
		
		/**
		 * Initializes the navigation-bar service.
		 */
		_this.$get = [
			'authentication',
			function(authentication) {
				// Initializes the navigation-bar service
				var navigationBar = new navigationBarService(authentication);

				// Adds the menus
				for (var userRole in menus) {
					if (! menus.hasOwnProperty(userRole)) {
						continue;
					}

					var userRoleMenus = menus[userRole];
					for (var i = 0; i < userRoleMenus.length; i++) {
						navigationBar.addMenu(userRoleMenus[i], userRole);
					}
				}

				return navigationBar;
			}
		];
		
		/**
		 * Registers a menu.
		 * 
		 * Receives the menu and the user role to which it corresponds.
		 */
		_this.registerMenu = function(menu, userRole) {
			menus[userRole].push(menu);
		};
	}
	
	/**
	 * Manages the navigation bar.
	 */
	function navigationBarService(authentication) {
		var _this = this;
		
		/**
		 * The menus, organized by user role.
		 */
		var menus = {
			ad: [],
			dr: [],
			op: []
		};
		
		/**
		 * Adds a menu.
		 * 
		 * Receives the menu and the user role to which it corresponds.
		 */
		_this.addMenu = function(menu, userRole) {
			menus[userRole].push(menu);
		};
		
		/**
		 * Returns the menus corresponding to the signed-in user's role.
		 */
		_this.getMenus = function() {
			// Gets the signed-in user's role
			var userRole = authentication.getSignedInUser().role;
			
			// Gets the menus corresponding to the user role
			return menus[userRole];
		};
	}
})();
