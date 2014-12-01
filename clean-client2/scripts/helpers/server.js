// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: server
	module.service('server', [
		'$q', // TODO: remove
		'$resource',
		'$timeout', // TODO: remove
		serverService
	]);
	
	/*
	 * Service: server
	 * 
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through this service.
	 */
	function serverService($q, $resource, $timeout) {
		var service = this;
		
		// TODO: remove mocking data
		var loggedIn = true;
		var loggedInUserId = 'federicojasson';
		var users = [
			{
				id: 'federicojasson',
				mainData: {
					firstNames: 'Federico Rodrigo',
					lastNames: 'Jasson',
					gender: 'm',
					email: 'federicojasson@something.com',
					role: 'dr'
				},
				metadata: {
					creationDatetime: '2014-11-30T19:20:30+00:00'
				}
			}
		];
		
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
		function sendHttpRequest(request) {
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
		}
		
		/*
		 * TODO
		 */
		service.getAuthentication = function() {
			var deferred = $q.defer();
			
			$timeout(function() {
				deferred.resolve({
					loggedIn: loggedIn,
					userId: loggedInUserId
				});
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationImageAnalysis = function(consultationId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferred.resolve(consultations[i].imageAnalysis);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationLaboratoryResults = function(consultationId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferred.resolve(consultations[i].laboratoryResults);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationMainData = function(consultationId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferred.resolve(consultations[i].mainData);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationMetadata = function(consultationId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferred.resolve(consultations[i].metadata);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationNeurocognitiveAssessment = function(consultationId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferred.resolve(consultations[i].neurocognitiveAssessment);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationPatientBackground = function(consultationId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferred.resolve(consultations[i].patientBackground);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationPatientMedications = function(consultationId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferred.resolve(consultations[i].patientMedications);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationTreatments = function(consultationId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferred.resolve(consultations[i].treatments);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getExperimentFiles = function(experimentId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === experimentId) {
						deferred.resolve(experiments[i].files);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getExperimentMainData = function(experimentId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === experimentId) {
						deferred.resolve(experiments[i].mainData);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getExperimentMetadata = function(experimentId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === experimentId) {
						deferred.resolve(experiments[i].metadata);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getFileMainData = function(fileId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < files.length; i++) {
					if (files[i].id === fileId) {
						deferred.resolve(files[i].mainData);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getFileMetadata = function(fileId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < files.length; i++) {
					if (files[i].id === fileId) {
						deferred.resolve(files[i].metadata);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getPatientMainData = function(patientId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < patients.length; i++) {
					if (patients[i].id === patientId) {
						deferred.resolve(patients[i].mainData);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getPatientMetadata = function(patientId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < patients.length; i++) {
					if (patients[i].id === patientId) {
						deferred.resolve(patients[i].metadata);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getStudyFiles = function(studyId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === studyId) {
						deferred.resolve(studies[i].files);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getStudyMainData = function(studyId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === studyId) {
						deferred.resolve(studies[i].mainData);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getStudyMetadata = function(studyId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === studyId) {
						deferred.resolve(studies[i].metadata);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getUserMainData = function(userId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < users.length; i++) {
					if (users[i].id === userId) {
						deferred.resolve(users[i].mainData);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.getUserMetadata = function(userId) {
			var deferred = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < users.length; i++) {
					if (users[i].id === userId) {
						deferred.resolve(users[i].metadata);
						return;
					}
				}
				
				deferred.reject();
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.logIn = function(userId, userPassword) {
			var deferred = $q.defer();
			
			$timeout(function() {
				var user = null;
				for (var i = 0; i < users.length; i++) {
					if (users[i].id === userId) {
						user = users[i];
						break;
					}
				}
				
				if (user !== null) {
					loggedIn = true;
					loggedInUserId = userId;
				}
				
				deferred.resolve({
					loggedIn: loggedIn
				});
			}, 100);
			
			return deferred.promise;
		};
		
		/*
		 * TODO
		 */
		service.logOut = function() {
			var deferred = $q.defer();
			
			$timeout(function() {
				loggedIn = false;
				loggedInUserId = null;
				deferred.resolve();
			}, 100);
			
			return deferred.promise;
		};
	}
})();
