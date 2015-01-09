// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateTreatmentViewController
	module.controller('CreateTreatmentViewController', CreateTreatmentViewController);
	
	/*
	 * Controller: CreateTreatmentViewController
	 * 
	 * Offers functions for the create treatment view.
	 */
	function CreateTreatmentViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-treatment-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar tratamiento - ETRS';
		};
	}
})();
