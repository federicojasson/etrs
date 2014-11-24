// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreatePatientFormController
	module.controller('CreatePatientFormController', [
		'builder',
		'errorManager',
		'server',
		CreatePatientFormController
	]);
	
	/*
	 * Controller: CreatePatientFormController
	 * 
	 * Offers logic functions for the create patient form.
	 */
	function CreatePatientFormController(builder, errorManager, server) {
		var controller = this;
		
		/*
		 * TODO: comments
		 */
		var currentArea = 'data';
		
		/*
		 * The TODO input model.
		 */
		var TODOInputModel = builder.buildInputModel(function() {
			// TODO
		});
		
		/*
		 * Validates the form input and returns the result.
		 */
		function validate() {
			// The form input is valid if all the input models are
			var isValid = true;
			
			// Gets the input models
			var inputModels = controller.inputModels;
			
			// Validates the input models
			for (var property in inputModels) {
				if (inputModels.hasOwnProperty(property)) {
					// Validates the input model and ANDs the result
					isValid &= inputModels[property].validate();
				}
			}
			
			return isValid;
		}
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			// TODO
		};
		
		/*
		 * TODO: comments
		 */
		controller.isCurrentArea = function(area) {
			return area === currentArea;
		};
		
		/*
		 * TODO: comments
		 */
		controller.setCurrentArea = function(area) {
			currentArea = area;
		};
		
		/*
		 * Submits the form.
		 * 
		 * If any of the input models is invalid, the appropriate actions are
		 * taken and the form is not submitted.
		 */
		controller.submit = function() {
			if (! validate()) {
				// At least one input model is invalid
				return;
			}
			
			// Gets the input values
			var TODO = TODOInputModel.value;
			
			// Creates the patient
			server.createPatient(TODO).then(function(response) {
				// TODO
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = builder.buildError(response);
				errorManager.reportError(error);
			});
		};
	}
})();
