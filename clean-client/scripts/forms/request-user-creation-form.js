// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: RequestUserCreationFormController
	module.controller('RequestUserCreationFormController', [
		'InputModel',
		'inputValidator',
		'server',
		RequestUserCreationFormController
	]);
	
	/*
	 * Controller: RequestUserCreationFormController
	 * 
	 * Implements the logic of the request user creation form.
	 */
	function RequestUserCreationFormController(InputModel, inputValidator, server) {
		var controller = this;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			userEmailAddress: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validateEmailAddress(this)
				}
			}),
			
			userRole: new InputModel()
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
			var userEmailAddress = inputModels.userEmailAddress;
			var userRole = inputModels.userRole;
			
			// Requests the user creation
			server.requestUserCreation(userEmailAddress, userRole).then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
