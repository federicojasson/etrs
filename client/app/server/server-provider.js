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
	angular.module('app.server').provider('server', serverProvider);
	
	/**
	 * Responsible for initializing the server service.
	 */
	function serverProvider() {
		var _this = this;
		
		/**
		 * Initializes the server service.
		 */
		_this.$get = [
			'$resource',
			function($resource) {
				// Initializes the server service
				var server = new serverService($resource);
				
				// TODO: implement function
				
				return server;
			}
		];
		
		// TODO: implement provider
	}
	
	/**
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through the provided interface.
	 */
	function serverService() {
		var _this = this;
		
		// TODO: implement service
	}
})();
