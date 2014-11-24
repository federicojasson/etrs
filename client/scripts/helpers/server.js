// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: server
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
		
		var users = [
			{
				data: {
					firstNames: 'Agustina',
					gender: 'f',
					id: 'administrator',
					lastNames: 'Fernández',
					role: 'ad'
				}
			},

			{
				data: {
					firstNames: 'Fernando',
					gender: 'm',
					id: 'doctor',
					lastNames: 'Rodríguez',
					role: 'dr'
				}
			},

			{
				data: {
					firstNames: 'Romina',
					gender: 'f',
					id: 'operator',
					lastNames: 'Sánchez',
					role: 'op'
				}
			},

			{
				data: {
					firstNames: 'Gerardo',
					gender: 'm',
					id: 'researcher',
					lastNames: 'Díaz',
					role: 'rs'
				}
			}
		];
		
		var patients = [
			{
				data: {
					birthDate: '1991-06-25',
					firstNames: 'Federico Rodrigo',
					gender: 'm',
					id: '/PrWVv98TfOjrJDq5i3IMg==',
					lastNames: 'Jasson'
				}
			},
			
			{
				data: {
					birthDate: '1978-05-22',
					firstNames: 'Martynne',
					gender: 'f',
					id: 'tpGpEOlfTQSHU8b2b2e28Q==',
					lastNames: 'Ariosto'
				}
			},
			
			{
				data: {
					birthDate: '1957-05-11',
					firstNames: 'Adah',
					gender: 'f',
					id: 'quQ1wF01SxSOh4RJ5aOKFg==',
					lastNames: 'Zak'
				}
			},
			
			{
				data: {
					birthDate: '1937-11-23',
					firstNames: 'Valentijn Quill',
					gender: 'm',
					id: '1Xn2IEsCQ92JGkqN/pMjNw==',
					lastNames: 'Monti'
				}
			},
			
			{
				data: {
					birthDate: '1970-09-04',
					firstNames: 'Jelene Rowe',
					gender: 'f',
					id: 'D4tB6r/JRGuD02EQW5Uj3g==',
					lastNames: 'Poehler'
				}
			}
		];
		
		
		/*
		 * Requests the following service:
		 * 
		 * URL:		/server/get-authentication-state
		 * Method:	POST
		 */
		service.getAuthenticationState = function() {
			// TODO: mocking
			var deferred = $q.defer();
			
			//deferred.reject();
			
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
			}, 0);
			
			return deferred.promise;
			
			/*var request = {
				method: 'POST',
				responseIsArray: false,
				url: 'server/get-authentication-state'
			};
			
			return communicator.sendHttpRequest(request);*/
		};
		
		/*
		 * TODO
		 */
		service.getPatientData = function(patientId) {
			// TODO: mocking
			var deferred = $q.defer();
			
			$timeout(function() {
				var patient = null;
				for (var i = 0; i < patients.length; i++) {
					if (patients[i].data.id === patientId) {
						patient = patients[i];
						break;
					}
				}
				
				deferred.resolve({
					patient: patient
				});
			}, 0);
			
			return deferred.promise;
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
				var user = null;
				for (var i = 0; i < users.length; i++) {
					if (users[i].data.id === userId) {
						user = users[i];
						break;
					}
				}
				
				deferred.resolve({
					user: user
				});
			}, 0);
			
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
				var user = null;
				for (var i = 0; i < users.length; i++) {
					if (users[i].data.id === userId) {
						user = users[i];
						break;
					}
				}
				
				if (user !== null) {
					loggedIn = true;
					userLoggedInId = userId;
				}
				
				deferred.resolve({
					loggedIn: loggedIn
				});
			}, 200);
			
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
			
			$timeout(function() {
				loggedIn = false;
				userLoggedInId = null;
				deferred.resolve();
			}, 200);
			
			/*deferred.reject({
				data: {
					errorId: 'ERROR_TESTING'
				},
				status: 500
			});*/
			
			return deferred.promise;
			
			/*var request = {
				method: 'POST',
				responseIsArray: false,
				url: 'server/log-out'
			};
			
			return communicator.sendHttpRequest(request);*/
		};
		
		/*
		 * TODO
		 */
		service.searchPatients = function(searchString) {
			// TODO: mocking
			var deferred = $q.defer();
			
			$timeout(function() {
				var results = (searchString.length > 0)? patients : [];
				
				deferred.resolve({
					results: results
				});
			}, 200);
			
			return deferred.promise;
		};
	}
})();
