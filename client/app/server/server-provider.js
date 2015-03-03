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
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through the provided interface.
	 */
	function serverProvider() {
		var _this = this;
		
		/**
		 * Initializes the service.
		 */
		_this.$get = [
			'$resource',
			construct
		];
		
		/**
		 * Registers a service.
		 * 
		 * Receives the URL of the service.
		 */
		_this.registerService = function(url) {
			// TODO: implement
		};
	}
	
	/**
	 * TODO: comment
	 */
	function construct($resource) {// TODO: rename
		/**
		 * TODO: comment
		 */
		function Server() {
			// TODO: implement
		}
		
		/**
		 * Sends a request to the server.
		 * 
		 * Receives the URL of the service and, optionally, the input to be
		 * sent.
		 */
		function sendRequest(url, input) {
			// Initializes the input if is undefined
			input = (angular.isDefined(input)) ? input : {};
			
			// Builds the definitive URL
			url = 'server' + url;
			
			// Sends the request
			var deferredTask = $resource(url).save(input);
			
			// Returns the promise of the deferred task
			return deferredTask.$promise;
		}
		
		return Server;
	}
})();
