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
		 * Namespace objects.
		 */
		service.doctor = {};
		service.operator = {};
		service.researcher = {};
		service.user = {};
		
		/*
		 * URL: 'server/user/get-authentication-state'.
		 * 
		 * Returns the user authentication state.
		 */
		service.user.getAuthenticationState = function() {
			var request = {
				method: 'POST',
				responseIsArray: false,
				url: 'server/user/get-authentication-state'
			};
			
			return communicator.sendHttpRequest(request);
		};
		
		/*
		 * URL: 'server/user/get-user'.
		 * 
		 * Returns a user's data.
		 */
		service.user.getUser = function(userId) {
			var input = {
				userId: userId
			};
			
			var request = {
				input: input,
				method: 'POST',
				responseIsArray: false,
				url: 'server/user/get-user'
			};
			
			return communicator.sendHttpRequest(request);
		};
		
		/*
		 * URL: 'server/user/log-in'.
		 * 
		 * Logs in a user in the server.
		 */
		service.user.logIn = function(userId, userPassword) {
			var input = {
				userId: userId,
				userPassword: userPassword
			};
			
			var request = {
				input: input,
				method: 'POST',
				responseIsArray: false,
				url: 'server/user/log-in'
			};
			
			return communicator.sendHttpRequest(request);
		};
		
		/*
		 * URL: 'server/user/log-out'.
		 * 
		 * Logs out the user from the server.
		 */
		service.user.logOut = function() {
			var request = {
				method: 'POST',
				responseIsArray: false,
				url: 'server/user/log-out'
			};
			
			return communicator.sendHttpRequest(request);
		};
	}
})();
