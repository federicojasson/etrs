// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: PatientViewController
	module.controller('PatientViewController', [
		'$location',
		'$q',
		'$routeParams',
		'base64ToHexadecimalFilter',
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
	function PatientViewController($location, $q, $routeParams, base64ToHexadecimalFilter, builder, errorManager, hexadecimalToBase64Filter, server) {
		var controller = this;
		
		/*
		 * TODO
		 */
		var isReady = false;
		
		var consultations = null;
		
		/*
		 * TODO
		 */
		var patient = null;
		
		function loadUser(consultation, userId) {
			var promise = server.getUserData(userId);
			
			promise.then(function(response) {
				consultation.metadata.creator = response.user;
			});
			
			return promise;
		}
		
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
				
				return server.getConsultations(patientId);
			}).then(function(response) {
				// Sets the consultations
				consultations = response.consultations;
				
				var promises = [];
				
				for (var i = 0; i < consultations.length; i++) {
					promises.push(loadUser(consultations[i], consultations[i].metadata.creator));
				}
				
				return $q.all(promises);
			}).then(function() {
				// The view is ready
				isReady = true;
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = builder.buildError(response);
				errorManager.reportError(error);
			});
		}
		
		/*
		 * TODO
		 */
		controller.getConsultations = function() {
			return consultations;
		};
		
		/*
		 * Returns the patient.
		 */
		controller.getPatient = function() {
			return patient;
		};
		
		/*
		 * TODO
		 */
		controller.goToConsultationRoute = function(id) {
			// Converts the ID to hexadecimal
			var hexadecimalId = base64ToHexadecimalFilter(id);
			
			// Redirects the user to the patient route
			$location.path('/consultation/' + hexadecimalId);
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
