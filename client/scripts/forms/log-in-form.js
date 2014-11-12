// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms');
	
	// Controllers
	module.controller('LogInFormController', [
		'$route',
		'Error',
		'InputModel',
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
	 * Offers logic functions for the log in form.
	 */
	function LogInFormController($route, Error, InputModel, authenticationManager, errorManager, server) {
		var controller = this;
		
		/*
		 * Indicates whether the informative alert should be included.
		 */
		var includeInformativeAlert = false;
		
		/*
		 * The user ID input model.
		 */
		var userIdInputModel = new InputModel(function() {
			this.isInputValid = true;
			this.message = '';

			if (this.value.length === 0) {
				// The input is invalid
				this.isInputValid = false;
				this.message = 'Ingrese un nombre de usuario';
			}

			return this.isInputValid;
		});
		
		/*
		 * The user password input model.
		 */
		var userPasswordInputModel = new InputModel(function() {
			this.isInputValid = true;
			this.message = '';

			if (this.value.length === 0) {
				// The input is invalid
				this.isInputValid = false;
				this.message = 'Ingrese su contraseña';
			}
			
			return this.isInputValid;
		});
		
		/*
		 * Validates the form input and returns the result.
		 */
		function validate() {
			// The form input is valid if all the input models are
			var isValid = true;
			
			// Gets the input models
			var inputModels = controller.inputModels;
			
			// Validates the input models
			for (var property in inputModels) {
				if (inputModels.hasOwnProperty(property)) {
					// Gets the input model
					var inputModel = inputModels[property];
					
					// Validates the input model and ANDs the result
					isValid &= inputModel.validate();
				}
			}
			
			return isValid;
		}
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			userId: userIdInputModel,
			userPassword: userPasswordInputModel
		};
		
		/*
		 * Closes the informative alert.
		 */
		controller.closeInformativeAlert = function() {
			includeInformativeAlert = false;
		};
		
		/*
		 * Determines whether the informative alert should be included.
		 */
		controller.includeInformativeAlert = function() {
			return includeInformativeAlert;
		};
		
		/*
		 * Submits the form.
		 * 
		 * If any of the input models is invalid, the appropriate actions are
		 * taken and the form is not submitted.
		 */
		controller.submit = function() {
			// Hides the informative alert
			includeInformativeAlert = false;
			
			if (! validate()) {
				// At least one input model is invalid
				return;
			}
			
			// Gets the input values
			var userId = userIdInputModel.getValue();
			var userPassword = userPasswordInputModel.getValue();
			
			// Logs in the user
			server.user.logIn(userId, userPassword).then(function(response) {
				if (response.loggedIn) {
					// The user was logged in
					
					// Refreshes the authentication state
					authenticationManager.refreshAuthenticationState();
					
					// Reloads the route to show the loading view until the
					// refresh is over
					$route.reload(); // TODO: maybe someone could be watching for changes and reloads
				} else {
					// The user was not logged in
					
					// Shows an informative alert
					includeInformativeAlert = true;
				}
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = Error.createFromServerResponse(response);
				errorManager.reportError(error);
			});
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
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/forms/log-in-form.html'
		};
		
		return options;
	}
})();
