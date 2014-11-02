// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('IndexViewController', [
		'authenticationManager',
		IndexViewController
	]);
	
	/*
	 * Controller: IndexViewController.
	 * 
	 * Offers logic functions for the index view.
	 */
	function IndexViewController(authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the template URL of the view.
		 * The template to use depends on whether the user is logged in and on
		 * her role.
		 */
		controller.getTemplateUrl = function() {
			if (! authenticationManager.isUserLoggedIn()) {
				// The user is not logged in
				return 'templates/views/index/anonymous-index-view.html';
			}
			
			// The user is logged in, so the template URL depends on her role
			switch (authenticationManager.loggedInUser.role) {
				case 'DR' : return 'templates/views/index/doctor-index-view.html';
				case 'OP' : return 'templates/views/index/operator-index-view.html';
				case 'RS' : return 'templates/views/index/researcher-index-view.html';
				default : return ''; // TODO: what to do in this case?
			}
		};
		
		/*
		 * Determines whether the view is ready to be rendered.
		 */
		controller.isReady = function() {
			return ! authenticationManager.isRefreshing;
		};
	}
})();
