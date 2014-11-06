// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('helpers');
	
	// Services
	module.service('communication', [
		'$resource',
		communicationService
	]);
	
	/*
	 * Service: communication.
	 * 
	 * Offers functions to perform communication operations.
	 */
	function communicationService($resource) {
		/*
		 * Sends a GET request to a given URL.
		 */
		this.sendHttpGetRequest = function(url, input, responseIsArray, callbacks) {
			return sendHttpRequest('GET', url, input, responseIsArray, callbacks);
		};
		
		/*
		 * Sends a POST request to a given URL.
		 */
		this.sendHttpPostRequest = function(url, input, responseIsArray, callbacks) {
			return sendHttpRequest('POST', url, input, responseIsArray, callbacks);
		};
		
		/*
		 * Sends a HTTP request to a given URL.
		 * It allows to attach input data and execute callback functions to
		 * respond to different events.
		 * The HTTP method to use must be specified.
		 * 
		 * Callbacks:
		 * - onSuccess: called if the request succeeds.
		 * - onFailure: called if the request fails.
		 */
		function sendHttpRequest(method, url, input, responseIsArray, callbacks) {
			var bodyInput = {};
			var urlInput = {};
			
			if (method === 'GET') {
				// The input is sent through as a query string
				urlInput = input;
			} else {
				// The input is sent in the request body
				bodyInput = input;
			}
			
			// Sends the request
			var reference = $resource(url, urlInput, {
				sendRequest: {
					isArray: responseIsArray,
					method: method
				}
			}).sendRequest(bodyInput);
			
			// Registers the callback functions with the promise
			reference.$promise.then(callbacks.onSuccess, callbacks.onFailure);
			
			return reference;
		}
	}
})();
