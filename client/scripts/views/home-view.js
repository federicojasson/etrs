// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: HomeViewController
	module.controller('HomeViewController', HomeViewController);
	
	/*
	 * Controller: HomeViewController
	 * 
	 * Offers functions for the home view.
	 */
	function HomeViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/home-view.html';
		};
		
		/*
		 * Returns the title of the document when the view is active.
		 */
		controller.getTitle = function() {
			return 'ETRS';
		};
	}
})();
