// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('helpers');
	
	// Services
	module.service('server', [
		'$q', // TODO: mocking
		'$timeout', // TODO: mocking
		'communicator',
		serverService
	]);
	
	/*
	 * Service: server
	 * 
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through this service.
	 */
	function serverService($q, $timeout, communicator) {
		var service = this;
		
		// TODO: mocking
		var loggedIn = true;
		var userLoggedInId = 'doctor';
		var users = {};
		
		users['administrator'] = {
			data: {
				firstNames: 'Agustina',
				gender: 'f',
				id: 'administrator',
				lastNames: 'Fernández',
				role: 'ad'
			}
		};

		users['doctor'] = {
			data: {
				firstNames: 'Fernando',
				gender: 'm',
				id: 'doctor',
				lastNames: 'Rodríguez',
				role: 'dr'
			}
		};

		users['operator'] = {
			data: {
				firstNames: 'Romina',
				gender: 'f',
				id: 'operator',
				lastNames: 'Sánchez',
				role: 'op'
			}
		};

		users['researcher'] = {
			data: {
				firstNames: 'Gerardo',
				gender: 'm',
				id: 'researcher',
				lastNames: 'Díaz',
				role: 'rs'
			}
		};
		
		/*
		 * Requests the following service:
		 * 
		 * URL:		/server/get-authentication-state
		 * Method:	POST
		 */
		service.getAuthenticationState = function() {
			// TODO: mocking
			var deferred = $q.defer();
			
			$timeout(function() {
				if (loggedIn) {
					deferred.resolve({
						loggedIn: true,
						user: {
							data: {
								id: userLoggedInId
							}
						}
					});
				} else {
					deferred.resolve({
						loggedIn: false
					});
				}
			}, 1000);
			
			return deferred.promise;
			
			/*var request = {
				method: 'POST',
				responseIsArray: false,
				url: 'server/get-authentication-state'
			};
			
			return communicator.sendHttpRequest(request);*/
		};
		
		/*
		 * Requests the following service:
		 * 
		 * URL:		/server/get-user-data
		 * Method:	POST
		 */
		service.getUserData = function(userId) {
			// TODO: mocking
			var deferred = $q.defer();
			
			$timeout(function() {
				deferred.resolve({
					user: users[userId]
				});
			}, 1000);
			
			return deferred.promise;
			
			/*var input = {
				userId: userId
			};
			
			var request = {
				input: input,
				method: 'POST',
				responseIsArray: false,
				url: 'server/get-user-data'
			};
			
			return communicator.sendHttpRequest(request);*/
		};
		
		/*
		 * Requests the following service:
		 * 
		 * URL:		/server/log-in
		 * Method:	POST
		 */
		service.logIn = function(userId, userPassword) {
			// TODO: mocking
			var deferred = $q.defer();
			
			$timeout(function() {
				if (users.hasOwnProperty(userId)) {
					loggedIn = true;
					userLoggedInId = userId;
				}
				
				deferred.resolve({
					loggedIn: loggedIn
				});
			}, 1000);
			
			return deferred.promise;
			
			/*var input = {
				userId: userId,
				userPassword: userPassword
			};
			
			var request = {
				input: input,
				method: 'POST',
				responseIsArray: false,
				url: 'server/log-in'
			};
			
			return communicator.sendHttpRequest(request);*/
		};
		
		/*
		 * Requests the following service:
		 * 
		 * URL:		/server/log-out
		 * Method:	POST
		 */
		service.logOut = function() {
			// TODO: mocking
			var deferred = $q.defer();
			
			/*$timeout(function() {
				loggedIn = false;
				userLoggedInId = null;
				deferred.resolve();
			}, 1000);*/
			
			deferred.reject({
				data: {
					errorId: 'ERROR_TESTING'
				},
				status: 500
			});
			
			return deferred.promise;
			
			/*var request = {
				method: 'POST',
				responseIsArray: false,
				url: 'server/log-out'
			};
			
			return communicator.sendHttpRequest(request);*/
		};
	}
})();
