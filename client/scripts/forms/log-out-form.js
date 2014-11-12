// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms');
	
	// Controllers
	module.controller('LogOutFormController', [
		'$route',
		'Error',
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
	 * Offers logic functions for the log out form.
	 */
	function LogOutFormController($route, Error, authenticationManager, errorManager, server) {
		var controller = this;
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			// Logs out the user
			server.user.logOut().then(function(response) {
				// Refreshes the authentication state
				authenticationManager.refreshAuthenticationState();

				// Reloads the route to show the loading view until the refresh
				// is over
				$route.reload(); // TODO: maybe someone could be watching for changes and reloads
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = Error.createFromServerResponse(response);
				errorManager.reportFatalError(error);
			});
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
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/forms/log-out-form.html'
		};
		
		return options;
	}
})();
