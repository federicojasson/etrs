// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: UserViewController
	module.controller('UserViewController', [
		'$stateParams',
		'authentication',
		'views',
		UserViewController
	]);
	
	/*
	 * Controller: UserViewController
	 * 
	 * Offers functions for the user view.
	 */
	function UserViewController($stateParams, authentication, views) {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			if (authentication.isUserLoggedIn()) {
				// The user is logged in
				
				if ($stateParams.userId === authentication.getLoggedInUser().id) {
					// The user ID corresponds to the one logged in
					return 'templates/views/profile-view.html'
				}
			}
			
			return views.selectTemplateUrlOrRedirect({
				ad: 'templates/views/user-view.html',
				dr: 'templates/views/user-view.html',
				op: 'templates/views/user-view.html'
			});
		};
	}
})();
