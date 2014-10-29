// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('communications');
	
	// Services
	module.service('server', [ 'communicationHelper', serverService ]);
	
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
		service.doctor = {};
		service.operator = {};
		service.researcher = {};
		service.user = {};
		
		/*
		 * Path: 'server/user/get-authentication-state'.
		 * 
		 * Returns the user authentication state.
		 */
		service.user.getAuthenticationState = function(callbacks) {
			var url = 'server/user/get-authentication-state';
			communicationHelper.sendPostRequest(url, {}, callbacks);
		};
		
		/*
		 * Path: 'server/user/get-user'.
		 * 
		 * Returns a user's data.
		 */
		service.user.getUser = function(userId, callbacks) {
			var url = 'server/user/get-user';
			
			var input = {
				userId: userId
			};
			
			communicationHelper.sendPostRequest(url, input, callbacks);
		};
		
		/*
		 * Path: 'server/user/log-in'.
		 * 
		 * Logs in a user in the server.
		 */
		service.user.logIn = function(userId, userPassword, callbacks) {
			var url = 'server/user/log-in';
			
			var input = {
				userId: userId,
				userPassword: userPassword
			};
			
			communicationHelper.sendPostRequest(url, input, callbacks);
		};
		
		/*
		 * Path: 'server/user/log-out'.
		 * 
		 * Logs out the user from the server.
		 */
		service.user.logOut = function(callbacks) {
			var url = 'server/user/log-out';
			communicationHelper.sendPostRequest(url, {}, callbacks);
		};
	};
})();
