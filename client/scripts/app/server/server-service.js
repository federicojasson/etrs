/*
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
	angular.module('app.server').service('server', [
		'$resource',
		serverService
	]);
	
	/*
	 * TODO: comment
	 */
	function serverService($resource) {
		var _this = this;
		
		/*
		 * TODO: comment
		 */
		_this.sendHttpRequest = function(parameters) {
			// Extracts the parameters
			var url = parameters.url;
			var method = parameters.method;
			var input = parameters.input;
			
			// Initializes the input if is undefined
			input = (angular.isDefined(input))? input : {};
			
			// Initializes the input objects (only one will be actually used)
			var urlInput = {};
			var bodyInput = {};
			
			if (method === 'GET') {
				// The input is sent as a query string
				urlInput = input;
			} else {
				// The input is sent in the body of the request
				bodyInput = input;
			}
			
			// Sends the request
			var deferredTask = $resource('clean_server' + url, urlInput, { // TODO: replace clean_server by server
				request: {
					method: method
				}
			}).request(bodyInput);
			
			// Returns the promise of the deferred task
			return deferredTask.$promise;
		};
	}
})();
