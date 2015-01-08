// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateBackgroundViewController
	module.controller('CreateBackgroundViewController', CreateBackgroundViewController);
	
	/*
	 * Controller: CreateBackgroundViewController
	 * 
	 * Offers functions for the create background view.
	 */
	function CreateBackgroundViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-background-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar antecedente patológico - ETRS';
		};
	}
})();
