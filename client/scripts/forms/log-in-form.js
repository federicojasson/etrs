// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: LogInFormController
	module.controller('LogInFormController', [
		'authentication',
		'inputValidator',
		'InputModel',
		'server',
		LogInFormController
	]);
	
	/*
	 * Controller: LogInFormController
	 * 
	 * Offers functions for the log in form.
	 */
	function LogInFormController(authentication, inputValidator, InputModel, server) {
		var controller = this;
		
		/*
		 * Indicates whether the alert should be shown.
		 */
		var showAlert = false;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			id: new InputModel({
				validationFunction: function() {
					return inputValidator.validateRequiredInput(this);
				}
			}),
			
			password: new InputModel({
				validationFunction: function() {
					return inputValidator.validateRequiredInput(this);
				}
			})
		};
		
		/*
		 * Invoked when the alert's close button is pressed.
		 */
		controller.onCloseAlert = function() {
			showAlert = false;
		};
		
		/*
		 * Determines whether the alert should be shown.
		 */
		controller.showAlert = function() {
			return showAlert;
		};
		
		/*
		 * Submits the form.
		 * 
		 * If the input is invalid, the form is not submitted.
		 */
		controller.submit = function() {
			var inputModels = controller.inputModels;
			
			// Hides the alert
			showAlert = false;
			
			if (! inputValidator.validateInputModels(inputModels)) {
				// The input is invalid
				return;
			}
			
			// Logs in the user
			server.logIn({
				id: inputModels.id.value,
				password: inputModels.password.value
			}).then(function(output) {
				if (output.authenticated) {
					// The user was authenticated
					
					// Refreshes the authentication state
					authentication.refreshState();
				} else {
					// The user was not authenticated
					
					// Shows the alert
					showAlert = true;
				}
			}, function(response) {
				// TODO: handle error
			});
		};
	}
})();
