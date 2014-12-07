// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: LogInFormController
	module.controller('LogInFormController', [
		'$route',
		'authenticationManager',
		'builder',
		'errorManager',
		'server',
		LogInFormController
	]);
	
	/*
	 * Controller: LogInFormController
	 * 
	 * Offers logic functions for the log in form.
	 */
	function LogInFormController($route, authenticationManager, builder, errorManager, server) {
		var controller = this;
		
		/*
		 * Indicates whether the informative alert should be included.
		 */
		var includeInformativeAlert = false;
		
		/*
		 * The user ID input model.
		 */
		var userIdInputModel = builder.buildInputModel(function() {
			this.isValid = true;
			this.message = '';

			if (this.value.length === 0) {
				// The input is invalid
				this.isValid = false;
				this.message = 'Ingrese un nombre de usuario';
			}

			return this.isValid;
		});
		
		/*
		 * The user password input model.
		 */
		var userPasswordInputModel = builder.buildInputModel(function() {
			this.isValid = true;
			this.message = '';

			if (this.value.length === 0) {
				// The input is invalid
				this.isValid = false;
				this.message = 'Ingrese su contraseña';
			}
			
			return this.isValid;
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
					// Validates the input model and ANDs the result
					isValid &= inputModels[property].validate();
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
			var userId = userIdInputModel.value;
			var userPassword = userPasswordInputModel.value;
			
			// Logs in the user
			server.logIn(userId, userPassword).then(function(response) {
				if (response.loggedIn) {
					// The user was logged in
					
					// Refreshes the authentication state
					authenticationManager.refreshAuthenticationState();
					
					// Reloads the route to show the loading view
					$route.reload();
				} else {
					// The user was not logged in
					
					// Shows an informative alert
					includeInformativeAlert = true;
				}
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = builder.buildError(response);
				errorManager.reportError(error);
			});
		};
	}
})();
