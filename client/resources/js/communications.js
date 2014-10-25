// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('communications', [ 'ngResource' ]);
	
	// Services
	module.service('communicationHelper', [ '$resource', communicationHelperService ]);
	module.service('server', [ 'communicationHelper', serverService ]);
	
	/*
	 * Service: communicationHelper.
	 * 
	 * Offers functions to perform communication operations.
	 */
	function communicationHelperService($resource) {
		var service = this;
		
		/*
		 * Sends a POST request to a given URL.
		 * It allows to attach input data and execute callback functions to
		 * respond to different events.
		 * 
		 * Callbacks:
		 * - onSuccess: called if the request succeeds.
		 * - onFailure: called if the request fails.
		 */
		service.sendPostRequest = function(url, input, callbacks) {
			// Sends the POST request
			var reference = $resource(url).save(input);
			
			// Registers the callback functions to the promise
			reference.$promise.then(callbacks.onSuccess, callbacks.onFailure);
			
			return reference;
		};
	};
	
	/*
	 * Service: server.
	 * 
	 * Exposes the server API.
	 * All requests to the server should be done through this service.
	 */
	function serverService(communicationHelper) {
		var service = this;
		
		/*
		 * Namespace objects.
		 */
		service.anonymous = {};
		service.doctor = {};
		service.operator = {};
		service.researcher = {};
		
		/*
		 * Path: 'server/anonymous/get-authentication-state'.
		 * 
		 * Returns the user authentication state.
		 */
		service.anonymous.getAuthenticationState = function(callbacks) {
			var url = 'server/anonymous/get-authentication-state';
			
			communicationHelper.sendPostRequest(url, {}, callbacks);
		};
		
		/*
		 * Path: 'server/anonymous/log-in'.
		 * 
		 * Logs in a user in the server.
		 */
		service.anonymous.logIn = function(id, password, callbacks) {
			var url = 'server/anonymous/log-in';
			
			var input = {
				id: id,
				password: password
			};
			
			communicationHelper.sendPostRequest(url, input, callbacks);
		};
		
		/*
		 * Path: 'server/anonymous/log-out'.
		 * 
		 * Logs out the user from the server.
		 */
		service.anonymous.logOut = function(callbacks) {
			var url = 'server/anonymous/log-out';
			
			communicationHelper.sendPostRequest(url, {}, callbacks);
		};
	};
})();
