// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms');
	
	// Controllers
	module.controller('LogInFormController', [
		'authenticationManager',
		'errorManager',
		'server',
		LogInFormController
	]);
	
	// Directives
	module.directive('logInForm', logInFormDirective);
	
	/*
	 * Controller: LogInFormController.
	 * 
	 * Offers functions related to the log in form.
	 */
	function LogInFormController(authenticationManager, errorManager, server) {
		var controller = this;
		
		/*
		 * Indicates which model values have not passed the validation, using
		 * flags. It also keeps the error messages that are being shown for each
		 * model.
		 */
		controller.errors = {
			userId: {
				flag: false,
				message: ''
			},
			userPassword: {
				flag: false,
				message: ''
			}
		};
		
		/*
		 * The form data model.
		 */
		controller.model = {
			userId: '',
			userPassword: ''
		};
		
		/*
		 * Resets the errors.
		 */
		controller.resetErrors = function() {
			controller.errors = {
				userId: {
					flag: false,
					message: ''
				},
				userPassword: {
					flag: false,
					message: ''
				}
			};
		};
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			if (! controller.validateInput()) {
				// The input is invalid, so the form is not submitted
				return;
			}
			
			// Gets the input data
			var userId = controller.model.userId;
			var userPassword = controller.model.userPassword;
			
			/*
			 * If the user was logged in, it refreshes the authentication state.
			 */
			var onSuccess = function(response) {
				if (response.loggedIn) {
					// The user was logged in
					authenticationManager.refresh();
				}
			};
			
			/*
			 * Reports the error to the error manager.
			 */
			var onFailure = function(response) {
				// Reports the error
				errorManager.reportError(response);
			};
			
			var callbacks = {
				onSuccess: onSuccess,
				onFailure: onFailure
			};
			
			// Sends a request to the server
			server.user.logIn(userId, userPassword, callbacks);
		};
		
		/*
		 * Validates the input, setting the errors accordingly.
		 * Returns whether the input data is valid.
		 */
		controller.validateInput = function() {
			var isInputValid = true;
			
			// Resets the errors
			controller.resetErrors();
			
			// Gets the input data
			var userId = controller.model.userId;
			var userPassword = controller.model.userPassword;
			
			if (userId.length === 0) {
				// The user ID es invalid
				isInputValid = false;
				
				// Sets the corresponding error
				var error = controller.errors.userId;
				error.flag = true;
				error.message = 'Ingrese un nombre de usuario';
			}
			
			if (userPassword.length === 0) {
				// The user password es invalid
				isInputValid = false;
				
				// Sets the corresponding error
				var error = controller.errors.userPassword;
				error.flag = true;
				error.message = 'Ingrese su contraseña';
			}
			
			return isInputValid;
		};
	}
	
	/*
	 * Directive: logInForm.
	 * 
	 * Includes the log in form.
	 */
	function logInFormDirective() {
		var options = {
			controller: 'LogInFormController',
			controllerAs: 'form',
			restrict: 'E',
			templateUrl: 'templates/forms/log-in-form.html'
		};
		
		return options;
	}
})();
