// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('helpers');
	
	// Services
	module.service('communicator', [
		'$resource',
		communicatorService
	]);
	
	/*
	 * Service: communicator
	 * 
	 * Offers functions to perform communication operations.
	 */
	function communicatorService($resource) {
		var service = this;
				
		/*
		 * Sends a HTTP request to a given URL.
		 * 
		 * It receives a request object that holds the URL, the HTTP method to
		 * use, the input and whether the expected response is an array. This
		 * object should have the following structure:
		 * 
		 *	request: {
		 *		input: ...,
		 *		method: ...,
		 *		responseIsArray: ...,
		 *		url: ...
		 *	}
		 *	
		 * The input property is optional, for cases in which there is no need
		 * to send input.
.		 * 
		 * The function returns a promise that gets resolved when the server
		 * responds.
		 */
		service.sendHttpRequest = function(request) {
			// Gets the request parameters
			var input = request.input;
			var method = request.method;
			var responseIsArray = request.responseIsArray;
			var url = request.url;
			
			// Initializes undefined optional parameters with default values
			input = (angular.isDefined(input))? input : {};
			
			// Initializes the input objects (only one will be actually used)
			var bodyInput = {};
			var urlInput = {};
			
			if (method === 'GET') {
				// The input is sent as a query string
				urlInput = input;
			} else {
				// The input is sent in the request body
				bodyInput = input;
			}
			
			// Sends the request
			var deferred = $resource(url, urlInput, {
				sendRequest: {
					isArray: responseIsArray,
					method: method
				}
			}).sendRequest(bodyInput);
			
			// Returns the promise
			return deferred.$promise;
		};
	}
})();
