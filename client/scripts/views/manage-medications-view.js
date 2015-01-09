// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageMedicationsViewController
	module.controller('ManageMedicationsViewController', ManageMedicationsViewController);
	
	/*
	 * Controller: ManageMedicationsViewController
	 * 
	 * Offers functions for the manage medications view.
	 */
	function ManageMedicationsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-medications-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar medicamentos - ETRS';
		};
	}
})();
