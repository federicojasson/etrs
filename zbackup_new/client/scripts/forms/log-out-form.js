// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: LogOutFormController
	module.controller('LogOutFormController', [
		'$route',
		'authenticationManager',
		'builder',
		'errorManager',
		'server',
		LogOutFormController
	]);
	
	/*
	 * Controller: LogOutFormController
	 * 
	 * Offers logic functions for the log out form.
	 */
	function LogOutFormController($route, authenticationManager, builder, errorManager, server) {
		var controller = this;
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			// Logs out the user
			server.logOut().then(function() {
				// Refreshes the authentication state
				authenticationManager.refreshAuthenticationState();

				// Reloads the route to show the loading view
				$route.reload();
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = builder.buildError(response);
				errorManager.reportError(error);
			});
		};
	}
})();
