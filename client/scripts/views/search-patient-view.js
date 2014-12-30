// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: SearchPatientViewController
	module.controller('SearchPatientViewController', SearchPatientViewController);
	
	/*
	 * Controller: SearchPatientViewController
	 * 
	 * Offers functions for the search patient view.
	 */
	function SearchPatientViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/search-patient-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Buscar paciente - ETRS';
		};
	}
})();
