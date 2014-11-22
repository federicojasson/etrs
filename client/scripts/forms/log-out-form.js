// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms');
	
	// Controllers
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

				// Reloads the route to show the loading view until the refresh
				// is over
				$route.reload(); // TODO: maybe someone could be watching for changes and reloads
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = builder.buildError(response);
				errorManager.reportError(error);
			});
		};
	}
})();
