// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: LogOutFormController
	module.controller('LogOutFormController', [
		'$location',
		'authentication',
		'server',
		LogOutFormController
	]);
	
	/*
	 * Controller: LogOutFormController
	 * 
	 * Implements the logic of the log out form.
	 */
	function LogOutFormController($location, authentication, server) {
		var controller = this;
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			// Logs out the user
			server.logOut().then(function() {
				// Refreshes the authentication state
				authentication.refreshState();

				// Redirects the user to the root route
				$location.path('/');
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
