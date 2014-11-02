// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms');
	
	// Controllers
	module.controller('LogOutFormController', [
		'authenticationManager',
		'errorManager',
		'server',
		LogOutFormController
	]);
	
	// Directives
	module.directive('logOutForm', logOutFormDirective);
	
	/*
	 * Controller: LogOutFormController.
	 * 
	 * Offers functions related to the log out form.
	 */
	function LogOutFormController(authenticationManager, errorManager, server) {
		var controller = this;
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			/*
			 * Refreshes the authentication state.
			 */
			var onSuccess = function() {
				authenticationManager.refresh();
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
			server.user.logOut(callbacks);
		};
	}
	
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
	}
})();
