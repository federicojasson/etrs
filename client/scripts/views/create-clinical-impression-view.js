// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateClinicalImpressionViewController
	module.controller('CreateClinicalImpressionViewController', CreateClinicalImpressionViewController);
	
	/*
	 * Controller: CreateClinicalImpressionViewController
	 * 
	 * Offers functions for the create clinical impression view.
	 */
	function CreateClinicalImpressionViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-clinical-impression-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar impresión clínica - ETRS';
		};
	}
})();
