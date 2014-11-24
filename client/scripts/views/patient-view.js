// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: PatientViewController
	module.controller('PatientViewController', [
		'$routeParams',
		'builder',
		'errorManager',
		'hexadecimalToBase64Filter',
		'server',
		PatientViewController
	]);
	
	/*
	 * Controller: PatientViewController
	 * 
	 * Offers logic functions for the patient view.
	 */
	function PatientViewController($routeParams, builder, errorManager, hexadecimalToBase64Filter, server) {
		var controller = this;
		
		/*
		 * TODO
		 */
		var isReady = false;
		
		/*
		 * TODO
		 */
		var patient = null;
		
		/*
		 * TODO
		 */
		function loadView() {
			// TODO: validate URL input (or add functionality in view manager)
			var patientId = hexadecimalToBase64Filter($routeParams.patientId);
			
			// Gets the patient's data
			server.getPatientData(patientId).then(function(response) {
				// Sets the logged in user
				patient = response.patient;
				
				// The view is ready
				isReady = true;
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = builder.buildError(response);
				errorManager.reportError(error);
			});
		}
		
		/*
		 * Returns the patient.
		 */
		controller.getPatient = function() {
			return patient;
		};
		
		/*
		 * TODO
		 */
		controller.isReady = function() {
			return isReady;
		};
		
		// TODO: comments
		loadView();
	}
})();
