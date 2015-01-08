// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageBackgroundsViewController
	module.controller('ManageBackgroundsViewController', ManageBackgroundsViewController);
	
	/*
	 * Controller: ManageBackgroundsViewController
	 * 
	 * Offers functions for the manage backgrounds view.
	 */
	function ManageBackgroundsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-backgrounds-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar antecedentes patológicos - ETRS';
		};
	}
})();
