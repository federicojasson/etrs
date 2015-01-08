// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: CreateImageTestViewController
	module.controller('CreateImageTestViewController', CreateImageTestViewController);
	
	/*
	 * Controller: CreateImageTestViewController
	 * 
	 * Offers functions for the create image test view.
	 */
	function CreateImageTestViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/create-image-test-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ingresar TODO: name - ETRS';
		};
	}
})();
