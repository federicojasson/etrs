// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: LogOutFormController
	module.controller('LogOutFormController', [
		'authentication',
		'server',
		LogOutFormController
	]);
	
	/*
	 * Controller: LogOutFormController
	 * 
	 * Offers functions for the log out form.
	 */
	function LogOutFormController(authentication, server) {
		var controller = this;
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			// Logs out the user
			server.logOut().then(function() {
				// Refreshes the authentication state
				authentication.refreshState();
			}, function(response) {
				// TODO: handle error
			});
		};
	}
})();
