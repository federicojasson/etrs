// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts');
	
	// Controller: SiteLayoutController
	module.controller('SiteLayoutController', SiteLayoutController);
	
	/*
	 * Controller: SiteLayoutController
	 * 
	 * Offers functions for the site layout.
	 */
	function SiteLayoutController() {
		var controller = this;
		
		/*
		 * Returns the URL of the layout's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/layouts/site-layout.html';
		};
		
		/*
		 * Returns the title of the document when the layout is active.
		 */
		controller.getTitle = function() {
			return 'ETRS';
		};
	}
})();
