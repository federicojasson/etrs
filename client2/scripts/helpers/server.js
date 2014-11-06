// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('helpers');
	
	// Services
	module.service('server', [
		'communication',
		serverService
	]);
	
	/*
	 * Service: server.
	 * 
	 * Exposes the server API.
	 * All requests to the server should be done through this service.
	 */
	function serverService(communication) {
		/*
		 * Namespace objects.
		 */
		this.doctor = {};
		this.operator = {};
		this.researcher = {};
		this.user = {};
		
		/*
		 * Path: 'server/user/get-authentication-state'.
		 * 
		 * Returns the user authentication state.
		 */
		this.user.getAuthenticationState = function(callbacks) {
			var url = 'server/user/get-authentication-state';
			communication.sendHttpPostRequest(url, {}, false, callbacks);
		};
		
		/*
		 * Path: 'server/user/get-user'.
		 * 
		 * Returns a user's data.
		 */
		this.user.getUser = function(userId, callbacks) {
			var url = 'server/user/get-user';
			
			var input = {
				userId: userId
			};
			
			communication.sendHttpPostRequest(url, input, false, callbacks);
		};
		
		/*
		 * Path: 'server/user/log-in'.
		 * 
		 * Logs in a user in the server.
		 */
		this.user.logIn = function(userId, userPassword, callbacks) {
			var url = 'server/user/log-in';
			
			var input = {
				userId: userId,
				userPassword: userPassword
			};
			
			communication.sendHttpPostRequest(url, input, false, callbacks);
		};
		
		/*
		 * Path: 'server/user/log-out'.
		 * 
		 * Logs out the user from the server.
		 */
		this.user.logOut = function(callbacks) {
			var url = 'server/user/log-out';
			communication.sendHttpPostRequest(url, {}, false, callbacks);
		};
	}
})();
