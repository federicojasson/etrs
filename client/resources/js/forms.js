// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms', [ 'communications' ]);
	
	// Controllers
	module.controller('LogInFormController', [ 'server', LogInFormController ]);
	
	// Directives
	module.directive('logInForm', logInFormDirective);
	
	/*
	 * Controller: LogInFormController.
	 * 
	 * Offers functions related to the log in form.
	 */
	function LogInFormController(server) {
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
				// The input is invalid, so the form is not submitted
				return;
			}
			
			// Gets the input data
			var password = controller.model.password;
			var userId = controller.model.userId;
			
			// Defines the callbacks
			var callbacks = {
				onSuccess: function(output) {
					console.log('success: ');
					console.log(output);
					// TODO: onSuccess
				},
				
				onFailure: function(output) {
					console.log('failure: ');
					console.log(output);
					// TODO: onFailure
				}
			};
			
			// Sends a request to the server
			server.anonymous.logIn(password, userId, callbacks);
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
