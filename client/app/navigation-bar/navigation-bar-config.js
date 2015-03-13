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
	angular.module('app.navigationBar').config([
		'navigationBarProvider',
		config
	]);
	
	/**
	 * Configures the module.
	 */
	function config(navigationBarProvider) {
		/**
		 * Returns the menu items.
		 */
		function getMenuItems() {
			return {
				medicines: {
					name: 'Administrar',
					url: '/medicines',
					description: 'Administre los medicamentos del sistema'
				},
				
				newMedicine: {
					name: 'Nuevo',
					url: '/medicine/new',
					description: 'Cree un nuevo medicamento'
				},
				
				signUp: {
					name: 'Enviar invitación',
					url: '/account/sign-up',
					description: 'Invite a una persona a registrarse en ETRS'
				}
			};
		}
		
		/**
		 * Returns the menus.
		 */
		function getMenus() {
			// Gets the menu items
			var menuItems = getMenuItems();
			
			return {
				ad: [
					{
						name: 'Usuarios',
						items: [
							menuItems.signUp
						]
					},
					
					{
						name: 'Medicamentos',
						items: [
							menuItems.medicines,
							menuItems.newMedicine
						]
					}
				],
				
				dr: [],
				op: []
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Gets the menus
		var menus = getMenus();
		
		// Registers the menus
		for (var userRole in menus) { if (! menus.hasOwnProperty(userRole)) continue;
			var userRoleMenus = menus[userRole];
			for (var i = 0; i < userRoleMenus.length; i++) {
				navigationBarProvider.registerMenu(userRoleMenus[i], userRole);
			}
		}
	}
})();
