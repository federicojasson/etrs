// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageClinicalImpressionsViewController
	module.controller('ManageClinicalImpressionsViewController', ManageClinicalImpressionsViewController);
	
	/*
	 * Controller: ManageClinicalImpressionsViewController
	 * 
	 * Offers functions for the manage clinical impressions view.
	 */
	function ManageClinicalImpressionsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-clinical-impressions-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar impresiones clínicas - ETRS';
		};
	}
})();
