// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageExperimentsViewController
	module.controller('ManageExperimentsViewController', ManageExperimentsViewController);
	
	/*
	 * Controller: ManageExperimentsViewController
	 * 
	 * Offers functions for the manage experiments view.
	 */
	function ManageExperimentsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-experiments-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar experimentos - ETRS';
		};
	}
})();
