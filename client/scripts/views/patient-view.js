// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: PatientViewController
	module.controller('PatientViewController', PatientViewController);
	
	/*
	 * Controller: PatientViewController
	 * 
	 * Offers functions for the patient view.
	 */
	function PatientViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/patient-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Paciente - ETRS'; // TODO: change title
		};
	}
})();
