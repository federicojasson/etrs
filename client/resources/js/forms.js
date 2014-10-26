// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms', [ 'communications', 'users' ]);
	
	// Controllers
	module.controller('LogInFormController', [ 'authenticationManager', 'server', LogInFormController ]);
	module.controller('LogOutFormController', [ 'authenticationManager', 'server', LogOutFormController ]);
	
	// Directives
	module.directive('logInForm', logInFormDirective);
	module.directive('logOutForm', logOutFormDirective);
	
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
				// The input is invalid, so the form is not submitted
				return;
			}
			
			// Gets the input data
			var id = controller.model.id;
			var password = controller.model.password;
			
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
			server.anonymous.logIn(id, password, callbacks);
		};
	};
	
	/*
	 * Controller: LogOutFormController.
	 * 
	 * Offers functions related to the log out form.
	 */
	function LogOutFormController(authenticationManager, server) {
		var controller = this;
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			/*
			 * Refreshes the authentication state.
			 */
			var onSuccess = function(output) {
				authenticationManager.refresh();
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
			server.anonymous.logOut(callbacks);
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
	
	/*
	 * Directive: logOutForm.
	 * 
	 * Includes the log out form.
	 */
	function logOutFormDirective() {
		var options = {
			controller: 'LogOutFormController',
			controllerAs: 'form',
			restrict: 'E',
			templateUrl: 'templates/forms/log-out-form.html'
		};
		
		return options;
	};
})();
