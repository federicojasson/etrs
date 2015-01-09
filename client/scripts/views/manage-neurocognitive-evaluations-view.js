// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageNeurocognitiveEvaluationsViewController
	module.controller('ManageNeurocognitiveEvaluationsViewController', ManageNeurocognitiveEvaluationsViewController);
	
	/*
	 * Controller: ManageNeurocognitiveEvaluationsViewController
	 * 
	 * Offers functions for the manage neurocognitive evaluations view.
	 */
	function ManageNeurocognitiveEvaluationsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-neurocognitive-evaluations-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar evaluaciones neurocognitivas - ETRS';
		};
	}
})();
