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
	angular.module('app.navigationBar').controller('NavigationBarController', [
		'navigationBar',
		NavigationBarController
	]);
	
	/**
	 * Provides means to use the navigation-bar service.
	 */
	function NavigationBarController(navigationBar) {
		var _this = this;
		
		// TODO: use for mocking
		var menuItems = {
			hacer1: {
				name: 'Hacer 1',
				url: '/URL1',
				description: 'Descripción 1 puede ser tan larga como esto? Tal vez dejarla más corta'
			},

			hacer2: {
				name: 'Hacer 2',
				url: '/URL2',
				description: 'Descripción 2'
			},

			hacer3: {
				name: 'Hacer 3',
				url: '/URL3',
				description: 'Descripción 3'
			}
		};
		var menus = [
			{
				name: 'Entidad 1',
				items: [
					menuItems.hacer1,
					menuItems.hacer2,
					menuItems.hacer3
				]
			},

			{
				name: 'Entidad 2',
				items: [
					menuItems.hacer1,
					menuItems.hacer2,
					menuItems.hacer3
				]
			},

			{
				name: 'Entidad 3',
				items: [
					menuItems.hacer1,
					menuItems.hacer2,
					menuItems.hacer3
				]
			}
		];
		
		/**
		 * TODO: comment
		 */
		_this.getMenus = function() {
			//return navigationBar.getMenus();
			// TODO: mocking
			return menus;
		};
	}
})();
