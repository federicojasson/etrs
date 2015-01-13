// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateNeurocognitiveTestViewController
	module.controller('CreateNeurocognitiveTestViewController', CreateNeurocognitiveTestViewController);
	
	/*
	 * Controller: CreateNeurocognitiveTestViewController
	 * 
	 * Offers functions for the create neurocognitive test view.
	 */
	function CreateNeurocognitiveTestViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-neurocognitive-test-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar evaluación neurocognitiva - ETRS';
		};
	}
})();
