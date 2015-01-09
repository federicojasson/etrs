// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateMedicationViewController
	module.controller('CreateMedicationViewController', CreateMedicationViewController);
	
	/*
	 * Controller: CreateMedicationViewController
	 * 
	 * Offers functions for the create medication view.
	 */
	function CreateMedicationViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-medication-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar medicamento - ETRS';
		};
	}
})();
