// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ProfileViewController
	module.controller('ProfileViewController', ProfileViewController);
	
	/*
	 * Controller: ProfileViewController
	 * 
	 * Offers functions for the profile view.
	 */
	function ProfileViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/profile-view.html';
		};
	}
})();
