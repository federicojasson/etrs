// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('HelpViewController', [ 'authenticationManager', HelpViewController ]);
	
	/*
	 * Controller: HelpViewController.
	 * 
	 * Offers logic functions for the help view.
	 */
	function HelpViewController(authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the template URL of the view.
		 * The template to use depends on whether the user is logged in and on
		 * her role.
		 */
		controller.getTemplateUrl = function() {
			if (! authenticationManager.isUserLoggedIn()) {
				// The user is not logged in
				return 'templates/views/help/anonymous-help-view.html';
			}
			
			// The user is logged in, so the template URL depends on her role
			switch (authenticationManager.loggedInUser.role) {
				case 'DR' : return 'templates/views/help/doctor-help-view.html';
				case 'OP' : return 'templates/views/help/operator-help-view.html';
				case 'RS' : return 'templates/views/help/researcher-help-view.html';
				default : return ''; // TODO: what to do in this case?
			}
		}
		
		/*
		 * Determines whether the view is ready to be rendered.
		 */
		controller.isReady = function() {
			return ! authenticationManager.isRefreshing;
		};
	};
})();
