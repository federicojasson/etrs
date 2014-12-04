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
			userNewPassword: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validatePassword(this);
				}
			}),
			
			userNewPasswordConfirmation: new InputModel({
				validationFunction: function() {
					// Gets the entered password
					var password = controller.inputModels.userNewPassword.value;
					
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validatePasswordConfirmation(this, password);
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
			var userNewPassword = controller.inputModels.userNewPassword.value;
			var userPassword = controller.inputModels.userPassword.value;
			
			// Changes the password
			server.changePassword(userNewPassword, userPassword).then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
