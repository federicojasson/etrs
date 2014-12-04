// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateUserFormController
	module.controller('CreateUserFormController', [
		'InputModel',
		'inputValidator',
		'server',
		CreateUserFormController
	]);
	
	/*
	 * Controller: CreateUserFormController
	 * 
	 * Implements the logic of the create user form.
	 */
	function CreateUserFormController(InputModel, inputValidator, server) {
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
			// Gets the input models
			var inputModels = controller.inputModels;
			
			if (! inputValidator.validate(inputModels)) {
				// The input is invalid
				return;
			}
			
			// Gets the input
			// TODO
			
			// Creates the user
			server.createUser().then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
