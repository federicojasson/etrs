// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: UserViewController
	module.controller('UserViewController', UserViewController);
	
	/*
	 * Controller: UserViewController
	 * 
	 * Offers functions for the user view.
	 */
	function UserViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/user-view.html';
		};
		
		/*
		 * Returns the title of the document when the view is active.
		 */
		controller.getTitle = function() {
			return 'Usuario - ETRS'; // TODO: change title
		};
	}
})();
