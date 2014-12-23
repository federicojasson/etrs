// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: RequestPasswordRecoveryFormController
	module.controller('RequestPasswordRecoveryFormController', [
		'inputValidator',
		'InputModel',
		'server',
		RequestPasswordRecoveryFormController
	]);
	
	/*
	 * Controller: RequestPasswordRecoveryFormController
	 * 
	 * Offers functions for the request password recovery form.
	 */
	function RequestPasswordRecoveryFormController(inputValidator, InputModel, server) {
		var controller = this;
		
		/*
		 * Indicates whether the alert should be shown.
		 */
		var showAlert = false;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			emailAddress: new InputModel({
				validationFunction: function() {
					return inputValidator.validateRequiredInput(this);
				}
			}),
			
			id: new InputModel({
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
			
			// Requests the password recovery
			server.requestPasswordRecovery({
				emailAddress: inputModels.emailAddress.value,
				id: inputModels.id.value
			}).then(function(output) {
				// TODO: handle output
				/*if (output.authenticated) {
					// The user was authenticated
					
					// Refreshes the authentication state
					authentication.refreshState();
				} else {
					// The user was not authenticated
					
					// Shows the alert
					showAlert = true;
				}*/
			}, function(response) {
				// TODO: handle error
			});
		};
	}
})();
