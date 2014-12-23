// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: server
	var module = angular.module('server', [
		'ngResource'
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
		 *	URL:	/server/get-consultation-image-analysis
		 *	Method:	POST
		 */
		service.getConsultationImageAnalysis = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation-image-analysis',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-consultation-laboratory-results
		 *	Method:	POST
		 */
		service.getConsultationLaboratoryResults = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation-laboratory-results',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-consultation-main-data
		 *	Method:	POST
		 */
		service.getConsultationMainData = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation-main-data',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-consultation-metadata
		 *	Method:	POST
		 */
		service.getConsultationMetadata = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation-metadata',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-consultation-neurocognitive-assessment
		 *	Method:	POST
		 */
		service.getConsultationNeurocognitiveAssessment = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation-neurocognitive-assessment',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-consultation-patient-background
		 *	Method:	POST
		 */
		service.getConsultationPatientBackground = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation-patient-background',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-consultation-patient-medications
		 *	Method:	POST
		 */
		service.getConsultationPatientMedications = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation-patient-medications',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-consultation-treatments
		 *	Method:	POST
		 */
		service.getConsultationTreatments = function(input) {
			return sendHttpRequest({
				url: 'server/get-consultation-treatments',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-experiment-files
		 *	Method:	POST
		 */
		service.getExperimentFiles = function(input) {
			return sendHttpRequest({
				url: 'server/get-experiment-files',
				method: 'POST',
				input: input,
				outputIsArray: true
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-experiment-main-data
		 *	Method:	POST
		 */
		service.getExperimentMainData = function(input) {
			return sendHttpRequest({
				url: 'server/get-experiment-main-data',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-experiment-metadata
		 *	Method:	POST
		 */
		service.getExperimentMetadata = function(input) {
			return sendHttpRequest({
				url: 'server/get-experiment-metadata',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-file-main-data
		 *	Method:	POST
		 */
		service.getFileMainData = function(input) {
			return sendHttpRequest({
				url: 'server/get-file-main-data',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-file-metadata
		 *	Method:	POST
		 */
		service.getFileMetadata = function(input) {
			return sendHttpRequest({
				url: 'server/get-file-metadata',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-patient-main-data
		 *	Method:	POST
		 */
		service.getPatientMainData = function(input) {
			return sendHttpRequest({
				url: 'server/get-patient-main-data',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-patient-metadata
		 *	Method:	POST
		 */
		service.getPatientMetadata = function(input) {
			return sendHttpRequest({
				url: 'server/get-patient-metadata',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-study-files
		 *	Method:	POST
		 */
		service.getStudyFiles = function(input) {
			return sendHttpRequest({
				url: 'server/get-study-files',
				method: 'POST',
				input: input,
				outputIsArray: true
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-study-main-data
		 *	Method:	POST
		 */
		service.getStudyMainData = function(input) {
			return sendHttpRequest({
				url: 'server/get-study-main-data',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-study-metadata
		 *	Method:	POST
		 */
		service.getStudyMetadata = function(input) {
			return sendHttpRequest({
				url: 'server/get-study-metadata',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-user-main-data
		 *	Method:	POST
		 */
		service.getUserMainData = function(input) {
			return sendHttpRequest({
				url: 'server/get-user-main-data',
				method: 'POST',
				input: input,
				outputIsArray: false
			});
		};
		
		/*
		 * Requests the following service:
		 * 
		 *	URL:	/server/get-user-metadata
		 *	Method:	POST
		 */
		service.getUserMetadata = function(input) {
			return sendHttpRequest({
				url: 'server/get-user-metadata',
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
			// TODO: implement server side service
			return sendHttpRequest({
				url: 'server/request-password-recovery',
				method: 'POST',
				outputIsArray: false
			});
		};
	}
})();
