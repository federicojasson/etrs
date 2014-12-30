// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: HelpViewController
	module.controller('HelpViewController', HelpViewController);
	
	/*
	 * Controller: HelpViewController
	 * 
	 * Offers functions for the help view.
	 */
	function HelpViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/help-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Ayuda - ETRS';
		};
	}
})();
