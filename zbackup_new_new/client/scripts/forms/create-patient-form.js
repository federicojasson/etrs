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
			mainData: {
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
			}
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
			
			// Creates the patient
			server.createPatient({
				mainData: {
					birthDate: inputModels.mainData.birthDate.value,
					educationYears: inputModels.mainData.educationYears.value,
					firstName: inputModels.mainData.firstName.value,
					gender: inputModels.mainData.gender.value,
					lastName: inputModels.mainData.lastName.value
				}
			}).then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
