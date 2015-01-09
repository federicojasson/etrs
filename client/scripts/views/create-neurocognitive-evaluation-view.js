// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateNeurocognitiveEvaluationViewController
	module.controller('CreateNeurocognitiveEvaluationViewController', CreateNeurocognitiveEvaluationViewController);
	
	/*
	 * Controller: CreateNeurocognitiveEvaluationViewController
	 * 
	 * Offers functions for the create neurocognitive evaluation view.
	 */
	function CreateNeurocognitiveEvaluationViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-neurocognitive-evaluation-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar evaluación neurocognitiva - ETRS';
		};
	}
})();
