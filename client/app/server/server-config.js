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
	angular.module('app.server').config([
		'serverProvider',
		config
	]);
	
	/**
	 * Configures the module.
	 */
	function config(serverProvider) {
		/**
		 * Returns the services.
		 */
		function getServices() {
			return [
				'/account/edit',
				'/account/get',
				'/account/reset-password',
				'/account/reset-password/authenticate',
				'/account/reset-password/request',
				'/account/sign-in',
				'/account/sign-out',
				'/account/sign-up',
				'/account/sign-up/authenticate',
				'/account/sign-up/request',
				'/authentication/get-state',
				'/medicine/create',
				'/medicine/edit',
				'/medicine/get'
			];
		}
		
		// ---------------------------------------------------------------------
		
		// Gets the services
		var services = getServices();
		
		// Registers the services
		for (var i = 0; i < services.length; i++) {
			serverProvider.registerService(services[i]);
		}
	}
})();
