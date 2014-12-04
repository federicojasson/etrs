// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: LogInFormController
	module.controller('LogInFormController', [
		'InputModel',
		'authentication',
		'inputValidator',
		'server',
		LogInFormController
	]);
	
	/*
	 * Controller: LogInFormController
	 * 
	 * Implements the logic of the log in form.
	 */
	function LogInFormController(InputModel, authentication, inputValidator, server) {
		var controller = this;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			userId: new InputModel({
				validationFunction: function() {
					return inputValidator.validateRequiredInput(this);
				}
			}),
			
			userPassword: new InputModel({
				validationFunction: function() {
					return inputValidator.validateRequiredInput(this);
				}
			})
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
			var userId = controller.inputModels.userId.value;
			var userPassword = controller.inputModels.userPassword.value;
			
			// Logs in the user
			server.logIn(userId, userPassword).then(function(response) {
				if (response.loggedIn) {
					// The user was logged in
					
					// Refreshes the authentication state
					authentication.refreshState();
					
					// Reloads the route
					// TODO: HOW
				} else {
					// The user was not logged in
					
					// TODO
				}
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
