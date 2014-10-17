// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views', [ 'communications', 'ngRoute' ]);
	
	// Controllers
	module.controller('EditPatientViewController', [ '$routeParams', 'server', EditPatientViewController ]);
	
	/*
	 * Controller: EditPatientViewController.
	 * Gets the patient ID received in the route and initializes the patient
	 * model.
	 */
	function EditPatientViewController($routeParams, server) {
		var controller = this;
		
		/*
		 * Indicates whether the view is ready to be shown.
		 */
		controller.isReady = false;
		
		/*
		 * The patient to be edited. Its data is obtained through the server.
		 */
		controller.patient = {};
		
		/*
		 * Initializes the patient calling the server to fetch the data. Also,
		 * it takes the proper actions according to the result of this
		 * communication.
		 */
		controller.initializePatient = function() {
			var callbacks = {
				onSuccess: function() {
					// The server responded; the view is ready to be shown
					controller.isReady = true;
				},
				
				onFailure: function() {
					// TODO: on failure
					console.log('getPatient.onFailure');
				}
			};

			controller.patient = server.getPatient($routeParams.patientId, callbacks);
		};
		
		// Initializes the patient model
		controller.initializePatient();
	};
})();
