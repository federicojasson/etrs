// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts', [
		'ui.router',
		'authentication'
	]);
	
	// Directive: layout
	module.directive('layout', [
		'$controller',
		'$state',
		layoutDirective
	]);
	
	/*
	 * Directive: layout
	 * 
	 * Includes the layout.
	 */
	function layoutDirective($controller, $state) {
		/*
		 * Returns the directive's options.
		 */
		function getOptions() {
			return {
				link: link,
				scope: {},
				template: '<span ng-include="layout.getTemplateUrl()"></span>'
			};
		}
		
		/*
		 * Invoked during the linking phase.
		 */
		function link(scope) {
			// Binds the layout's controller to the scope
			scope.layout = $controller($state.current.layoutController);
		}
		
		// Gets and returns the directive's options
		return getOptions();
	}
})();
