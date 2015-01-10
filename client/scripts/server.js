// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: server
	var module = angular.module('server', [
		'app'
	]);
	
	// Service: server
	module.service('server', [
		'$resource',
		serverService
	]);
	
	/*
	 * Service: server
	 * 
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through this service.
	 */
	function serverService($resource) {
		var service = this;
		
		/*
		 * Sends an HTTP request to a given URL.
		 * 
		 * It receives an object containing the parameters: the URL, the HTTP
		 * method to use, the input and whether the expected output is an array.
		 * This object should have the following structure:
		 * 
		 *	parameters: {
		 *		url: ...,
		 *		method: ...,
		 *		input: ...,
		 *		outputIsArray: ...
		 *	}
		 * 
		 * The input property is optional, for cases in which there is no need
		 * to send input.
.		 * 
		 * The function returns a promise that gets resolved when the server
		 * responds.
		 */
		function sendHttpRequest(parameters) {
			var url = parameters.url;
			var method = parameters.method;
			var input = parameters.input;
			var outputIsArray = parameters.outputIsArray;
			
			// Initializes undefined optional parameters with default values
			input = (angular.isDefined(input))? input : {};
			
			// Initializes the input objects (only one will be actually used)
			var urlInput = {};
			var bodyInput = {};
			
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
					method: method,
					isArray: outputIsArray
				}
			}).sendRequest(bodyInput);
			
			// Returns the promise of the deferred task
			return deferredTask.$promise;
		}
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-background
		 *	Method:	POST
		 */
		service.createBackground = function(input) {
			return sendHttpRequest({
				url: 'server/create-background',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-clinical-impression
		 *	Method:	POST
		 */
		service.createClinicalImpression = function(input) {
			return sendHttpRequest({
				url: 'server/create-clinical-impression',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-diagnosis
		 *	Method:	POST
		 */
		service.createDiagnosis = function(input) {
			return sendHttpRequest({
				url: 'server/create-diagnosis',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-experiment
		 *	Method:	POST
		 */
		service.createExperiment = function(input) {
			return sendHttpRequest({
				url: 'server/create-experiment',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-image-test
		 *	Method:	POST
		 */
		service.createImageTest = function(input) {
			return sendHttpRequest({
				url: 'server/create-image-test',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-laboratory-test
		 *	Method:	POST
		 */
		service.createLaboratoryTest = function(input) {
			return sendHttpRequest({
				url: 'server/create-laboratory-test',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-medication
		 *	Method:	POST
		 */
		service.createMedication = function(input) {
			return sendHttpRequest({
				url: 'server/create-medication',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-neurocognitive-evaluation
		 *	Method:	POST
		 */
		service.createNeurocognitiveEvaluation = function(input) {
			return sendHttpRequest({
				url: 'server/create-neurocognitive-evaluation',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-patient
		 *	Method:	POST
		 */
		service.createPatient = function(input) {
			return sendHttpRequest({
				url: 'server/create-patient',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/create-treatment
		 *	Method:	POST
		 */
		service.createTreatment = function(input) {
			return sendHttpRequest({
				url: 'server/create-treatment',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-background
		 *	Method:	POST
		 */
		service.eraseBackground = function(input) {
			return sendHttpRequest({
				url: 'server/erase-background',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-clinical-impression
		 *	Method:	POST
		 */
		service.eraseClinicalImpression = function(input) {
			return sendHttpRequest({
				url: 'server/erase-clinical-impression',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-diagnosis
		 *	Method:	POST
		 */
		service.eraseDiagnosis = function(input) {
			return sendHttpRequest({
				url: 'server/erase-diagnosis',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-experiment
		 *	Method:	POST
		 */
		service.eraseExperiment = function(input) {
			return sendHttpRequest({
				url: 'server/erase-experiment',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-image-test
		 *	Method:	POST
		 */
		service.eraseImageTest = function(input) {
			return sendHttpRequest({
				url: 'server/erase-image-test',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-laboratory-test
		 *	Method:	POST
		 */
		service.eraseLaboratoryTest = function(input) {
			return sendHttpRequest({
				url: 'server/erase-laboratory-test',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-medication
		 *	Method:	POST
		 */
		service.eraseMedication = function(input) {
			return sendHttpRequest({
				url: 'server/erase-medication',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-neurocognitive-evaluation
		 *	Method:	POST
		 */
		service.eraseNeurocognitiveEvaluation = function(input) {
			return sendHttpRequest({
				url: 'server/erase-neurocognitive-evaluation',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/erase-treatment
		 *	Method:	POST
		 */
		service.eraseTreatment = function(input) {
			return sendHttpRequest({
				url: 'server/erase-treatment',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-authentication-state
		 *	Method:	POST
		 */
		service.getAuthenticationState = function() {
			return sendHttpRequest({
				url: 'server/get-authentication-state',
				method: 'POST',
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-background
		 *	Method:	POST
		 */
		service.getBackground = function(input) {
			return sendHttpRequest({
				url: 'server/get-background',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-clinical-impression
		 *	Method:	POST
		 */
		service.getClinicalImpression = function(input) {
			return sendHttpRequest({
				url: 'server/get-clinical-impression',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-consultation
		 *	Method:	POST
		 */
		service.getConsultation = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-diagnosis
		 *	Method:	POST
		 */
		service.getDiagnosis = function(input) {
			return sendHttpRequest({
				url: 'server/get-diagnosis',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-experiment
		 *	Method:	POST
		 */
		service.getExperiment = function(input) {
			return sendHttpRequest({
				url: 'server/get-experiment',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-file
		 *	Method:	POST
		 */
		service.getFile = function(input) {
			return sendHttpRequest({
				url: 'server/get-file',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-image-test
		 *	Method:	POST
		 */
		service.getImageTest = function(input) {
			return sendHttpRequest({
				url: 'server/get-image-test',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-laboratory-test
		 *	Method:	POST
		 */
		service.getLaboratoryTest = function(input) {
			return sendHttpRequest({
				url: 'server/get-laboratory-test',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-medication
		 *	Method:	POST
		 */
		service.getMedication = function(input) {
			return sendHttpRequest({
				url: 'server/get-medication',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-neurocognitive-evaluation
		 *	Method:	POST
		 */
		service.getNeurocognitiveEvaluation = function(input) {
			return sendHttpRequest({
				url: 'server/get-neurocognitive-evaluation',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-patient
		 *	Method:	POST
		 */
		service.getPatient = function(input) {
			return sendHttpRequest({
				url: 'server/get-patient',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-study
		 *	Method:	POST
		 */
		service.getStudy = function(input) {
			return sendHttpRequest({
				url: 'server/get-study',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-treatment
		 *	Method:	POST
		 */
		service.getTreatment = function(input) {
			return sendHttpRequest({
				url: 'server/get-treatment',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-user
		 *	Method:	POST
		 */
		service.getUser = function(input) {
			return sendHttpRequest({
				url: 'server/get-user',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/log-in
		 *	Method:	POST
		 */
		service.logIn = function(input) {
			return sendHttpRequest({
				url: 'server/log-in',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/log-out
		 *	Method:	POST
		 */
		service.logOut = function() {
			return sendHttpRequest({
				url: 'server/log-out',
				method: 'POST',
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/request-password-recovery
		 *	Method:	POST
		 */
		service.requestPasswordRecovery = function(input) {
			return sendHttpRequest({
				url: 'server/request-password-recovery',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/search-patients
		 *	Method:	POST
		 */
		service.searchPatients = function(input) {
			return sendHttpRequest({
				url: 'server/search-patients',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
	}
})();
