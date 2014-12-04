// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreatePatientFormController
	module.controller('CreatePatientFormController', [
		'InputModel',
		'inputValidator',
		'server',
		CreatePatientFormController
	]);
	
	/*
	 * Controller: CreatePatientFormController
	 * 
	 * Implements the logic of the create patient form.
	 */
	function CreatePatientFormController(InputModel, inputValidator, server) {
		var controller = this;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			// TODO
		};
		
		/*
		 * Submits the form.
		 * 
		 * If the input is invalid, the form is not submitted.
		 */
		controller.submit = function() {
			if (! inputValidator.validate(controller.inputModels)) {
				// The input is invalid
				return;
			}
			
			// Gets the input
			// TODO
			
			// Creates the patient
			server.createPatient().then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
