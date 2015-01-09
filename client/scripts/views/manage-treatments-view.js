// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageTreatmentsViewController
	module.controller('ManageTreatmentsViewController', ManageTreatmentsViewController);
	
	/*
	 * Controller: ManageTreatmentsViewController
	 * 
	 * Offers functions for the manage treatments view.
	 */
	function ManageTreatmentsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-treatments-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar tratamientos - ETRS';
		};
	}
})();
