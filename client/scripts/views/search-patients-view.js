// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: SearchPatientsViewController
	module.controller('SearchPatientsViewController', SearchPatientsViewController);
	
	/*
	 * Controller: SearchPatientsViewController
	 * 
	 * Offers functions for the search patients view.
	 */
	function SearchPatientsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/search-patients-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Buscar pacientes - ETRS';
		};
	}
})();
