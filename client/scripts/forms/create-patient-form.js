// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreatePatientFormController
	module.controller('CreatePatientFormController', [
		'errorHandler',
		'Error',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		CreatePatientFormController
	]);
	
	/*
	 * Controller: CreatePatientFormController
	 * 
	 * Offers functions for the create patient form.
	 */
	function CreatePatientFormController(errorHandler, Error, inputValidator, InputModel, router, server) {
		var controller = this;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			firstNames: new InputModel({
				validationFunction: function() {
					// TODO: implement
					return true;
				}
			}),
			
			lastNames: new InputModel({
				validationFunction: function() {
					// TODO: implement
					return true;
				}
			}),
			
			gender: new InputModel({
				validationFunction: function() {
					// TODO: implement
					return true;
				}
			}),
			
			birthDate: new InputModel({
				validationFunction: function() {
					// TODO: implement
					return true;
				}
			}),
			
			educationYears: new InputModel({
				validationFunction: function() {
					// TODO: implement
					return true;
				}
			})
		};
		
		/*
		 * TODO: comments
		 */
		controller.submit = function() {
			var inputModels = controller.inputModels;
			
			if (! inputValidator.validateInputModels(inputModels)) {
				// The input is invalid
				return;
			}
			
			// Creates the patient
			server.createPatient({
				firstNames: inputModels.firstNames.value,
				lastNames: inputModels.lastNames.value,
				gender: inputModels.gender.value,
				birthDate: inputModels.birthDate.value,
				educationYears: inputModels.educationYears.value
			}).then(function(output) {
				// Redirects the user to the patient route
				router.redirect('/patient/' + output.id);
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		};
	}
})();
