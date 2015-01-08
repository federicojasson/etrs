// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateLaboratoryTestViewController
	module.controller('CreateLaboratoryTestViewController', CreateLaboratoryTestViewController);
	
	/*
	 * Controller: CreateLaboratoryTestViewController
	 * 
	 * Offers functions for the create laboratory test view.
	 */
	function CreateLaboratoryTestViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-laboratory-test-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar TODO: name - ETRS';
		};
	}
})();
