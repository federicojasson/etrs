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
		 * The registered services.
		 */
		var services = [];
		
		/**
		 * Initializes the server service.
		 */
		_this.$get = [
			'$resource',
			'utility',
			function($resource, utility) {
				// Initializes the server service
				var server = new serverService($resource, utility, services);
				
				// Adds the services
				for (var i = 0; i < services.length; i++) {
					server.addService(services[i]);
				}
				
				return server;
			}
		];
		
		/**
		 * Registers a service.
		 * 
		 * Receives the service.
		 */
		_this.registerService = function(service) {
			services.push(service);
		};
	}
	
	/**
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through the provided interface.
	 */
	function serverService($resource, utility) {
		var _this = this;
		
		/**
		 * Adds a service.
		 * 
		 * Receives the URL of the service.
		 */
		_this.addService = function(url) {
			// Removes the leading slash
			var string = url.substr(1);

			// Gets the string fragments separated by slashes
			var fragments = string.split('/');

			// Converts the fragments to camelCase
			for (var i = 0; i < fragments.length; i++) {
				fragments[i] = utility.toCamelCase(fragments[i]);
			}
			
			// Creates the necessary properties and functions
			var object = _this;
			for (var i = 0; i < fragments.length; i++) {
				var fragment = fragments[i];

				if (i === fragments.length - 1) {
					// It is the last fragment

					// Creates a function for the service
					object[fragment] = function(input) {
						return sendRequest(url, input);
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
		};
		
		/**
		 * Sends a request to the server.
		 * 
		 * Receives the URL of the requested service and, optionally, the input
		 * to be sent.
		 */
		function sendRequest(url, input) {
			// Initializes the input if is undefined
			input = (angular.isDefined(input)) ? input : {};

			// Builds the definitive URL
			url = 'server' + url;

			// Sends the request to the server
			var deferredTask = $resource(url).save(input);

			// Returns the promise of the deferred task
			return deferredTask.$promise;
		}
	}
})();
