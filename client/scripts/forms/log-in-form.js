// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms');
	
	// Controllers
	module.controller('LogInFormController', [ 'authenticationManager', 'server', LogInFormController ]);
	
	// Directives
	module.directive('logInForm', logInFormDirective);
	
	/*
	 * Controller: LogInFormController.
	 * 
	 * Offers functions related to the log in form.
	 */
	function LogInFormController(authenticationManager, server) {
		var controller = this;
		
		/*
		 * The form data model.
		 */
		controller.model = {};
		
		/*
		 * Determines whether the input data is valid.
		 */
		controller.isInputValid = function() {
			// TODO: isInputValid
			// a chequear: si se ingreso el ID y el password (length > 0)
			// nada más para no dar indicios de usuarios o contraseñas válidas
			return true;
		};
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			if (! controller.isInputValid()) {
				// TODO: do something else to communicate the invalid input
				// The input is invalid, so the form is not submitted
				return;
			}
			
			// Gets the input data
			var userId = controller.model.userId;
			var userPassword = controller.model.userPassword;
			
			/*
			 * If the user was logged in, it refreshes the authentication state.
			 */
			var onSuccess = function(output) {
				if (output.loggedIn) {
					// The user was logged in
					authenticationManager.refresh();
				}
			};
			
			/*
			 * TODO: onFailure comments
			 */
			var onFailure = function(output) {
				// TODO: onFailure
			};
			
			var callbacks = {
				onSuccess: onSuccess,
				onFailure: onFailure
			};
			
			// Sends a request to the server
			server.user.logIn(userId, userPassword, callbacks);
		};
	};
	
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
	};
})();
