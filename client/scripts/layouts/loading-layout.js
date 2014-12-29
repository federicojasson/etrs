// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts');
	
	// Controller: LoadingLayoutController
	module.controller('LoadingLayoutController', LoadingLayoutController);
	
	/*
	 * Controller: LoadingLayoutController
	 * 
	 * Offers functions for the loading layout.
	 */
	function LoadingLayoutController() {
		var controller = this;
		
		/*
		 * Returns the URL of the layout's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/layouts/loading-layout.html';
		};
		
		/*
		 * Returns the title of the page when the layout is active.
		 */
		controller.getTitle = function() {
			return 'Cargando - ETRS';
		};
	}
})();
