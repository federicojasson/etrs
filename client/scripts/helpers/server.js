// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('helpers');
	
	// Services
	module.service('server', [
		'communicator',
		serverService
	]);
	
	/*
	 * Service: server.
	 * 
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through this service.
	 */
	function serverService(communicator) {
		var service = this;
		
		/*
		 * URL: 'server/get-authentication-state'.
		 * 
		 * Returns the user authentication state.
		 */
		service.getAuthenticationState = function() {
			var request = {
				method: 'POST',
				responseIsArray: false,
				url: 'server/get-authentication-state'
			};
			
			return communicator.sendHttpRequest(request);
		};
		
		/*
		 * URL: 'server/get-user'.
		 * 
		 * Returns a user's data.
		 */
		service.getUser = function(userId) {
			var input = {
				userId: userId
			};
			
			var request = {
				input: input,
				method: 'POST',
				responseIsArray: false,
				url: 'server/get-user'
			};
			
			return communicator.sendHttpRequest(request);
		};
		
		/*
		 * URL: 'server/log-in'.
		 * 
		 * Logs in a user in the server.
		 */
		service.logIn = function(userId, userPassword) {
			var input = {
				userId: userId,
				userPassword: userPassword
			};
			
			var request = {
				input: input,
				method: 'POST',
				responseIsArray: false,
				url: 'server/log-in'
			};
			
			return communicator.sendHttpRequest(request);
		};
		
		/*
		 * URL: 'server/log-out'.
		 * 
		 * Logs out the user from the server.
		 */
		service.logOut = function() {
			var request = {
				method: 'POST',
				responseIsArray: false,
				url: 'server/log-out'
			};
			
			return communicator.sendHttpRequest(request);
		};
	}
})();
