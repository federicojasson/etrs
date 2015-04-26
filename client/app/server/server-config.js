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
				'/account/change-password',
				'/account/edit',
				'/account/reset-password',
				'/account/sign-in',
				'/account/sign-out',
				'/account/sign-up',
				'/account/signed-in',
				'/clinical-impression/create',
				'/clinical-impression/delete',
				'/clinical-impression/edit',
				'/clinical-impression/get',
				'/clinical-impression/get-all',
				'/clinical-impression/search',
				'/cognitive-test/create',
				'/cognitive-test/delete',
				'/cognitive-test/edit',
				'/cognitive-test/get',
				'/cognitive-test/get-all',
				'/cognitive-test/search',
				'/consultation/create',
				'/consultation/delete',
				'/consultation/edit',
				'/consultation/get',
				'/diagnosis/create',
				'/diagnosis/delete',
				'/diagnosis/edit',
				'/diagnosis/get',
				'/diagnosis/get-all',
				'/diagnosis/search',
				'/experiment/create',
				'/experiment/delete',
				'/experiment/edit',
				'/experiment/get',
				'/experiment/get-all',
				'/experiment/search',
				'/file/download',
				'/file/edit',
				'/file/get',
				'/file/upload',
				'/imaging-test/create',
				'/imaging-test/delete',
				'/imaging-test/edit',
				'/imaging-test/get',
				'/imaging-test/get-all',
				'/imaging-test/search',
				'/laboratory-test/create',
				'/laboratory-test/delete',
				'/laboratory-test/edit',
				'/laboratory-test/get',
				'/laboratory-test/get-all',
				'/laboratory-test/search',
				'/log/get',
				'/log/search',
				'/medical-antecedent/create',
				'/medical-antecedent/delete',
				'/medical-antecedent/edit',
				'/medical-antecedent/get',
				'/medical-antecedent/get-all',
				'/medical-antecedent/search',
				'/medicine/create',
				'/medicine/delete',
				'/medicine/edit',
				'/medicine/get',
				'/medicine/get-all',
				'/medicine/search',
				'/patient/create',
				'/patient/delete',
				'/patient/edit',
				'/patient/get',
				'/patient/search',
				'/permission/password-reset/authenticate',
				'/permission/password-reset/request',
				'/permission/sign-up/authenticate',
				'/permission/sign-up/request',
				'/study/create',
				'/study/delete',
				'/study/edit',
				'/study/get',
				'/treatment/create',
				'/treatment/delete',
				'/treatment/edit',
				'/treatment/get',
				'/treatment/get-all',
				'/treatment/search',
				'/user/get'
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
