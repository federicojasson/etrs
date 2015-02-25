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
	angular.module('app.server').factory('Server', [
		'$resource',
		'utility',
		ServerFactory
	]);
	
	/**
	 * TODO: comment
	 */
	function ServerFactory($resource, utility) {
		/**
		 * TODO: comment
		 */
		function Server(services) {
			// Adds the services
			for (var httpMethod in services) { if (! services.hasOwnProperty(httpMethod)) continue;
				var urls = services[httpMethod];
				for (var i = 0; i < urls.length; i++) {
					addService(urls[i], httpMethod);
				}
			}
		}
		
		/**
		 * TODO: comment
		 */
		function addService(url, httpMethod) {
			// Prepends the HTTP method in lowercase to the URL
			var string = httpMethod.toLowerCase() + url;
			
			// Gets the string fragments separated by slashes
			var fragments = string.split('/');
			
			// Converts the fragments to camelCase
			for (var i = 0; i < fragments.length; i++) {
				fragments[i] = utility.toCamelCase(fragments[i]);
			}
			
			// Creates the objects and functions necessary for the service
			var object = Server.prototype;
			for (var i = 0; i < fragments.length; i++) {
				var fragment = fragments[i];
				
				if (i === fragments.length - 1) {
					// The fragment is the last
					
					// Initializes a function for the service
					object[fragment] = function(input) {
						return sendHttpRequest(url, httpMethod, input);
					};
					
					return;
				}
				
				// Gets the child of the object corresponding to the fragment
				var child = object[fragment];
				
				// Initializes the child if is undefined
				object[fragment] = (angular.isDefined(child)) ? child : {};
				
				// Sets the child as the current object
				object = object[fragment];
			}
		}
		
		/**
		 * TODO: comment
		 */
		function sendHttpRequest(url, httpMethod, input) {
			// Initializes the input if is undefined
			input = (angular.isDefined(input)) ? input : {};
			
			// Initializes the input objects (only one will be actually used)
			var queryStringInput = {};
			var bodyInput = {};
			
			if (httpMethod === 'GET') {
				// The input must be sent as a query string
				queryStringInput = input;
			} else {
				// The input must be sent in the body of the request
				bodyInput = input;
			}
			
			// Sends the request
			var deferredTask = $resource('server' + url, queryStringInput, {
				request: {
					method: httpMethod
				}
			}).request(bodyInput);
			
			// Returns the promise of the deferred task
			return deferredTask.$promise;
		}
		
		return Server;
	}
})();
