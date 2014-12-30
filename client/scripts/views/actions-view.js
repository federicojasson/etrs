// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ActionsViewController
	module.controller('ActionsViewController', ActionsViewController);
	
	/*
	 * Controller: ActionsViewController
	 * 
	 * Offers functions for the actions view.
	 */
	function ActionsViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/actions-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Acciones - ETRS';
		};
	}
})();
