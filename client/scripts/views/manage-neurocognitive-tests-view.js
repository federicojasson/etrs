// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageNeurocognitiveTestsViewController
	module.controller('ManageNeurocognitiveTestsViewController', ManageNeurocognitiveTestsViewController);
	
	/*
	 * Controller: ManageNeurocognitiveTestsViewController
	 * 
	 * Offers functions for the manage neurocognitive tests view.
	 */
	function ManageNeurocognitiveTestsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-neurocognitive-tests-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar evaluaciones neurocognitivas - ETRS';
		};
	}
})();
