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
	angular.module('app.navigation').provider('navigation', navigationProvider);
	
	/**
	 * TODO: comment
	 */
	function navigationProvider() {
		var _this = this;
		
		/**
		 * TODO: comment
		 */
		var menus = {};
		
		/**
		 * TODO: comment
		 */
		_this.$get = [
			'Navigation',
			function(Navigation) {
				return new Navigation(menus);
			}
		];
		
		/**
		 * TODO: comment
		 */
		_this.registerMenu = function(menu, userRole) {
			if (! menus.hasOwnProperty(userRole)) {
				// TODO: comment
				menus[userRole] = [];
			}
			
			// TODO: comment
			menus[userRole].push(menu);
		};
	}
})();
