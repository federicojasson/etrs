// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: ChangePasswordFormController
	module.controller('ChangePasswordFormController', [
		'InputModel',
		'inputValidator',
		'server',
		ChangePasswordFormController
	]);
	
	/*
	 * Controller: ChangePasswordFormController
	 * 
	 * Implements the logic of the change password form.
	 */
	function ChangePasswordFormController(InputModel, inputValidator, server) {
		var controller = this;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			newPassword: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validatePassword(this);
				}
			}),
			
			newPasswordConfirmation: new InputModel({
				validationFunction: function() {
					// Gets the entered new password
					var newPassword = controller.inputModels.newPassword.value;
					
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validatePasswordConfirmation(this, newPassword);
				}
			}),
			
			password: new InputModel({
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
			// Gets the input models
			var inputModels = controller.inputModels;
			
			if (! inputValidator.validate(inputModels)) {
				// The input is invalid
				return;
			}
			
			// Changes the user's password
			server.changePassword({
				newPassword: inputModels.newPassword.value,
				password: inputModels.password.value
			}).then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
