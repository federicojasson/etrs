// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateDiagnosisViewController
	module.controller('CreateDiagnosisViewController', CreateDiagnosisViewController);
	
	/*
	 * Controller: CreateDiagnosisViewController
	 * 
	 * Offers functions for the create diagnosis view.
	 */
	function CreateDiagnosisViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-diagnosis-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar diagnóstico - ETRS';
		};
	}
})();
