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
			birthDate: new InputModel(),
			
			educationYears: new InputModel({
				validationFunction: function() {
					// TODO
				}
			}),
			
			firstName: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validateName(this)
				}
			}),
			
			gender: new InputModel(),
			
			lastName: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validateName(this)
				}
			})
		};
		
		/*
		 * Submits the form.
		 * 
		 * If the input is invalid, the form is not submitted.
		 */
		controller.submit = function() {
			// Gets the input models
			var inputModels = controller.inputModels;
			
			if (! inputValidator.validate(inputModels)) {
				// The input is invalid
				return;
			}
			
			// Gets the input
			var birthDate = inputModels.birthDate.value;
			var educationYears = inputModels.educationYears.value;
			var firstName = inputModels.firstName.value;
			var gender = inputModels.gender.value;
			var lastName = inputModels.lastName.value;
			
			// Creates the patient
			server.createPatient().then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
