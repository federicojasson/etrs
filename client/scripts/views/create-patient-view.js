// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreatePatientViewController
	module.controller('CreatePatientViewController', CreatePatientViewController);
	
	/*
	 * Controller: CreatePatientViewController
	 * 
	 * Offers functions for the create patient view.
	 */
	function CreatePatientViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-patient-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar paciente - ETRS';
		};
	}
})();
