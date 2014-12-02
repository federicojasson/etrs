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
		var consultations = [];
		var experiments = [];
		var files = [];
		var patients = [];
		var studies = [];
		var users = [
			{
				id: 'federicojasson',
				mainData: {
					firstNames: 'Federico Rodrigo',
					lastNames: 'Jasson',
					gender: 'm',
					email: 'federicojasson@something.com',
					role: 'ad'
				},
				metadata: {
					creationDatetime: '2014-11-30T19:20:30+00:00'
				}
			}
		];
		
		/*
		 * Sends an HTTP request to a given URL.
		 * 
		 * It receives an object containing the parameters: the URL, the HTTP
		 * method to use, the input and whether the expected response is an
		 * array. This object should have the following structure:
		 * 
		 *	parameters: {
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
		function sendHttpRequest(parameters) {
			// Extracts the parameters
			var input = parameters.input;
			var method = parameters.method;
			var responseIsArray = parameters.responseIsArray;
			var url = parameters.url;
			
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
			var deferredTask = $resource(url, urlInput, {
				sendRequest: {
					isArray: responseIsArray,
					method: method
				}
			}).sendRequest(bodyInput);
			
			// Returns the promise
			return deferredTask.$promise;
		}
		
		/*
		 * TODO
		 */
		service.getAuthenticationState = function() {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				deferredTask.resolve({
					loggedIn: loggedIn,
					userId: loggedInUserId
				});
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationImageAnalysis = function(consultationId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferredTask.resolve(consultations[i].imageAnalysis);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationLaboratoryResults = function(consultationId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferredTask.resolve(consultations[i].laboratoryResults);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationMainData = function(consultationId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferredTask.resolve(consultations[i].mainData);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationMetadata = function(consultationId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferredTask.resolve(consultations[i].metadata);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationNeurocognitiveAssessment = function(consultationId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferredTask.resolve(consultations[i].neurocognitiveAssessment);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationPatientBackground = function(consultationId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferredTask.resolve(consultations[i].patientBackground);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationPatientMedications = function(consultationId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferredTask.resolve(consultations[i].patientMedications);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationTreatments = function(consultationId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === consultationId) {
						deferredTask.resolve(consultations[i].treatments);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getExperimentFiles = function(experimentId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === experimentId) {
						deferredTask.resolve(experiments[i].files);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getExperimentMainData = function(experimentId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === experimentId) {
						deferredTask.resolve(experiments[i].mainData);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getExperimentMetadata = function(experimentId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === experimentId) {
						deferredTask.resolve(experiments[i].metadata);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getFileMainData = function(fileId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < files.length; i++) {
					if (files[i].id === fileId) {
						deferredTask.resolve(files[i].mainData);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getFileMetadata = function(fileId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < files.length; i++) {
					if (files[i].id === fileId) {
						deferredTask.resolve(files[i].metadata);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getPatientMainData = function(patientId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < patients.length; i++) {
					if (patients[i].id === patientId) {
						deferredTask.resolve(patients[i].mainData);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getPatientMetadata = function(patientId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < patients.length; i++) {
					if (patients[i].id === patientId) {
						deferredTask.resolve(patients[i].metadata);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getStudyFiles = function(studyId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === studyId) {
						deferredTask.resolve(studies[i].files);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getStudyMainData = function(studyId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === studyId) {
						deferredTask.resolve(studies[i].mainData);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getStudyMetadata = function(studyId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === studyId) {
						deferredTask.resolve(studies[i].metadata);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getUserMainData = function(userId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < users.length; i++) {
					if (users[i].id === userId) {
						deferredTask.resolve(users[i].mainData);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getUserMetadata = function(userId) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < users.length; i++) {
					if (users[i].id === userId) {
						deferredTask.resolve(users[i].metadata);
						return;
					}
				}
				
				deferredTask.reject();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.logIn = function(userId, userPassword) {
			var deferredTask = $q.defer();
			
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
				
				deferredTask.resolve({
					loggedIn: loggedIn
				});
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.logOut = function() {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				loggedIn = false;
				loggedInUserId = null;
				deferredTask.resolve();
			}, 100);
			
			return deferredTask.promise;
		};
	}
})();
