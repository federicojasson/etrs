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
	angular.module('app.navigation').factory('Navigation', [
		'authentication',
		NavigationFactory
	]);
	
	/**
	 * TODO: comment
	 */
	function NavigationFactory(authentication) {
		/**
		 * TODO: comment
		 */
		function Navigation(menus) {
			this.menus = menus;
		}
		
		/**
		 * TODO: comment
		 */
		Navigation.prototype.menus = [];
		
		/**
		 * TOOD: comment
		 */
		Navigation.prototype.getMenus = function() {
			// Gets the signed-in user
			var signedInUser = authentication.getSignedInUser();
			
			// Returns the menus corresponding to the signed-in user's role
			return this.menus[signedInUser.role];
		};
		
		return Navigation;
	}
})();