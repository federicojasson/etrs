// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageLaboratoryTestsViewController
	module.controller('ManageLaboratoryTestsViewController', ManageLaboratoryTestsViewController);
	
	/*
	 * Controller: ManageLaboratoryTestsViewController
	 * 
	 * Offers functions for the manage laboratory tests view.
	 */
	function ManageLaboratoryTestsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-laboratory-tests-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar exámenes de laboratorio - ETRS';
		};
	}
})();
