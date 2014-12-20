// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ProfileViewController
	module.controller('ProfileViewController', [
		'views',
		ProfileViewController
	]);
	
	/*
	 * Controller: ProfileViewController
	 * 
	 * Offers functions for the profile view.
	 */
	function ProfileViewController(views) {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return views.selectTemplateUrlOrRedirect({
				ad: 'templates/views/profile-view.html',
				dr: 'templates/views/profile-view.html',
				op: 'templates/views/profile-view.html'
			});
		};
	}
})();
