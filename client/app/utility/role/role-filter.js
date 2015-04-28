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
	angular.module('app.utility.role').filter('role', roleFilter);
	
	/**
	 * Returns a user's role.
	 */
	function roleFilter() {
		/**
		 * Applies the filter.
		 * 
		 * Receives the user.
		 */
		function filter(user) {
			// Gets the roles
			var roles = getRoles();
			
			// Gets the role
			var role = roles[user.role];
			
			if (user.gender === 'f') {
				// The user is a woman
				role += 'a';
			}
			
			return role;
		}
		
		/**
		 * Returns the roles.
		 */
		function getRoles() {
			return {
				'ad': 'Administrador',
				'dr': 'Doctor',
				'op': 'Operador'
			};
		}
		
		// ---------------------------------------------------------------------
		
		return filter;
	}
})();
