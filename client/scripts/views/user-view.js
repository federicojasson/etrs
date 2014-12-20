// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: UserViewController
	module.controller('UserViewController', [
		'views',
		UserViewController
	]);
	
	/*
	 * Controller: UserViewController
	 * 
	 * Offers functions for the user view.
	 */
	function UserViewController(views) {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			// TODO: sent to profile view if user is the logged in
			
			return views.selectTemplateUrlOrRedirect({
				ad: 'templates/views/user-view.html',
				dr: 'templates/views/user-view.html',
				op: 'templates/views/user-view.html'
			});
		};
	}
})();
