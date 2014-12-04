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
			
			// Requests the user creation
			server.requestUserCreation().then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
