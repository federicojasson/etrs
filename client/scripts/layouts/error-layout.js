// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts');
	
	// Controller: ErrorLayoutController
	module.controller('ErrorLayoutController', ErrorLayoutController);
	
	/*
	 * Controller: ErrorLayoutController
	 * 
	 * Offers functions for the error layout.
	 */
	function ErrorLayoutController() {
		var controller = this;
		
		/*
		 * Returns the URL of the layout's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/layouts/error-layout.html';
		};
		
		/*
		 * Returns the title of the page when the layout is active.
		 */
		controller.getTitle = function() {
			return 'Error - ETRS';
		};
	}
})();
