// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageImageTestsViewController
	module.controller('ManageImageTestsViewController', ManageImageTestsViewController);
	
	/*
	 * Controller: ManageImageTestsViewController
	 * 
	 * Offers functions for the manage image tests view.
	 */
	function ManageImageTestsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-image-tests-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar TODO: name - ETRS';
		};
	}
})();
