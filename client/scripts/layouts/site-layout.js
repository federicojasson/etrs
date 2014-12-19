// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts');
	
	// Controller: SiteLayoutController
	module.controller('SiteLayoutController', [
		'authentication',
		SiteLayoutController
	]);
	
	/*
	 * Controller: SiteLayoutController
	 * 
	 * Offers functions for the site layout.
	 */
	function SiteLayoutController(authentication) {
		var controller = this;
		
		/*
		 * Returns the URL of the layout's template.
		 */
		controller.getTemplateUrl = function() {
			if (! authentication.isReady()) {
				// The authentication service is not ready
				return 'templates/layouts/loading-layout.html';
			}
			
			return 'templates/layouts/site-layout.html';
		};
	}
})();
