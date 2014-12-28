// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views', [
		'ui.router',
		'authentication',
		'router'
	]);
	
	// Directive: view
	module.directive('view', [
		'$controller',
		'$state',
		viewDirective
	]);
	
	/*
	 * Directive: view
	 * 
	 * Includes the view.
	 */
	function viewDirective($controller, $state) {
		/*
		 * Returns the directive's options.
		 */
		function getOptions() {
			return {
				link: link,
				scope: {},
				template: '<span ng-include="view.getTemplateUrl()"></span>'
			};
		}
		
		/*
		 * Invoked during the linking phase.
		 */
		function link(scope) {
			// Binds the view's controller to the scope
			scope.view = $controller($state.current.viewController);
		}
		
		// Gets and returns the directive's options
		return getOptions();
	}
})();
