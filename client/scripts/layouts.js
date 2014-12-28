// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts', [
		'authentication'
	]);
	
	// Controller: LayoutController
	module.controller('LayoutController', [
		'authentication',
		LayoutController
	]);
	
	// Directive: layout
	module.directive('layout', layoutDirective);
	
	/*
	 * Controller: LayoutController
	 * 
	 * TODO: comments
	 */
	function LayoutController(authentication) {
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
	
	/*
	 * Directive: layout
	 * 
	 * Includes the layout.
	 */
	function layoutDirective() {
		/*
		 * Returns the directive's options.
		 */
		function getOptions() {
			return {
				controller: 'LayoutController',
				controllerAs: 'layout',
				scope: {},
				template: '<span ng-include="layout.getTemplateUrl()"></span>'
			};
		}
		
		// Gets and returns the directive's options
		return getOptions();
	}
})();
