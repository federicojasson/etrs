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
		var loggedIn = false;
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
					emailAddress: 'federicojasson@something.com',
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
		 * method to use, the input and whether the expected output is an array.
		 * This object should have the following structure:
		 * 
		 *	parameters: {
		 *		input: ...,
		 *		method: ...,
		 *		outputIsArray: ...,
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
			var outputIsArray = parameters.outputIsArray;
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
					isArray: outputIsArray,
					method: method
				}
			}).sendRequest(bodyInput);
			
			// Returns the promise
			return deferredTask.$promise;
		}
		
		/*
		 * TODO
		 */
		service.changePassword = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				deferredTask.resolve();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.createExperiment = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				deferredTask.resolve();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.createPatient = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				deferredTask.resolve();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.createUser = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				deferredTask.resolve();
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getAuthenticationState = function() {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				deferredTask.resolve({
					id: loggedInUserId,
					loggedIn: loggedIn
				});
			}, 100);
			
			return deferredTask.promise;
		};
		
		/*
		 * TODO
		 */
		service.getConsultationImageAnalysis = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === input.id) {
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
		service.getConsultationLaboratoryResults = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === input.id) {
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
		service.getConsultationMainData = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === input.id) {
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
		service.getConsultationMetadata = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === input.id) {
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
		service.getConsultationNeurocognitiveAssessment = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === input.id) {
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
		service.getConsultationPatientBackground = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === input.id) {
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
		service.getConsultationPatientMedications = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === input.id) {
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
		service.getConsultationTreatments = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < consultations.length; i++) {
					if (consultations[i].id === input.id) {
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
		service.getExperimentFiles = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === input.id) {
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
		service.getExperimentMainData = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === input.id) {
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
		service.getExperimentMetadata = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < experiments.length; i++) {
					if (experiments[i].id === input.id) {
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
		service.getFileMainData = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < files.length; i++) {
					if (files[i].id === input.id) {
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
		service.getFileMetadata = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < files.length; i++) {
					if (files[i].id === input.id) {
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
		service.getPatientMainData = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < patients.length; i++) {
					if (patients[i].id === input.id) {
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
		service.getPatientMetadata = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < patients.length; i++) {
					if (patients[i].id === input.id) {
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
		service.getStudyFiles = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === input.id) {
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
		service.getStudyMainData = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === input.id) {
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
		service.getStudyMetadata = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < studies.length; i++) {
					if (studies[i].id === input.id) {
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
		service.getUserMainData = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < users.length; i++) {
					if (users[i].id === input.id) {
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
		service.getUserMetadata = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				for (var i = 0; i < users.length; i++) {
					if (users[i].id === input.id) {
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
		service.logIn = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				var user = null;
				for (var i = 0; i < users.length; i++) {
					if (users[i].id === input.id) {
						user = users[i];
						break;
					}
				}
				
				if (user !== null) {
					loggedIn = true;
					loggedInUserId = input.id;
				}
				
				deferredTask.resolve({
					authenticated: loggedIn
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
		
		/*
		 * TODO
		 */
		service.requestUserCreation = function(input) {
			var deferredTask = $q.defer();
			
			$timeout(function() {
				deferredTask.resolve();
			}, 100);
			
			return deferredTask.promise;
		};
	}
})();
