// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: LogOutFormController
	module.controller('LogOutFormController', [
		'authentication',
		'errorHandler',
		'Error',
		'server',
		LogOutFormController
	]);
	
	/*
	 * Controller: LogOutFormController
	 * 
	 * Offers functions for the log out form.
	 */
	function LogOutFormController(authentication, errorHandler, Error, server) {
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
				// The server responded with an HTTP error
				var error = Error.createFromResponse(response);
				errorHandler.reportError(error);
			});
		};
	}
})();
