// Uses strict mode in the whole script
'use strict';

(function() {
	angular.module('app.communications').service('server', [
		'$resource',
		serverService
	]);
	
	/*
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through this service.
	 */
	function serverService($resource) {
		var service = this;
		
		/*
		 * Sends an HTTP request to a given URL.
		 * 
		 * It receives an object containing the parameters: the URL, the HTTP
		 * method to use, the input and whether the expected output is an array.
		 * This object should have the following structure:
		 * 
		 *	parameters: {
		 *		url: ...,
		 *		method: ...,
		 *		input: ...,
		 *		outputIsArray: ...
		 *	}
		 * 
		 * The input property is optional (in case there is no need to send
		 * input).
.		 * 
		 * The function returns a promise that gets resolved when the server
		 * responds.
		 */
		function sendHttpRequest(parameters) {
			var url = parameters.url;
			var method = parameters.method;
			var input = parameters.input;
			var outputIsArray = parameters.outputIsArray;
			
			// Initializes undefined optional parameters with default values
			input = (angular.isDefined(input))? input : {};
			
			// Initializes the input objects (only one will be actually used)
			var urlInput = {};
			var bodyInput = {};
			
			if (method === 'GET') {
				// The input is sent as a query string
				urlInput = input;
			} else {
				// The input is sent in the request body
				bodyInput = input;
			}
			
			// Sends the request
			var deferredTask = $resource(url, urlInput, {
				sendRequest: {
					method: method,
					isArray: outputIsArray
				}
			}).sendRequest(bodyInput);
			
			// Returns the promise of the deferred task
			return deferredTask.$promise;
		}
		
		// TODO: comments
		service.authentication = {};
		service.experiments = {};
		service.patients = {};
		service.users = {};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/authentication/get-state
		 *	Method:	POST
		 */
		service.authentication.getState = function() {
			return sendHttpRequest({
				url: 'server/authentication/get-state',
				method: 'POST',
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/authentication/sign-in
		 *	Method:	POST
		 */
		service.authentication.signIn = function(input) {
			return sendHttpRequest({
				url: 'server/authentication/sign-in',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/authentication/sign-out
		 *	Method:	POST
		 */
		service.authentication.signOut = function() {
			return sendHttpRequest({
				url: 'server/authentication/sign-out',
				method: 'POST',
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/experiments/create
		 *	Method:	POST
		 */
		service.experiments.create = function(input) {
			return sendHttpRequest({
				url: 'server/experiments/create',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/experiments/edit
		 *	Method:	POST
		 */
		service.experiments.edit = function(input) {
			return sendHttpRequest({
				url: 'server/experiments/edit',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/experiments/erase
		 *	Method:	POST
		 */
		service.experiments.erase = function(input) {
			return sendHttpRequest({
				url: 'server/experiments/erase',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/experiments/get
		 *	Method:	POST
		 */
		service.experiments.get = function(input) {
			return sendHttpRequest({
				url: 'server/experiments/get',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/experiments/search
		 *	Method:	POST
		 */
		service.experiments.search = function(input) {
			return sendHttpRequest({
				url: 'server/experiments/search',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/patients/get
		 *	Method:	POST
		 */
		service.patients.get = function(input) {
			return sendHttpRequest({
				url: 'server/patients/get',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/users/get
		 *	Method:	POST
		 */
		service.users.get = function(input) {
			return sendHttpRequest({
				url: 'server/users/get',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
	}
})();
