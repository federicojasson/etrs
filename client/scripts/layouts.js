// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts', [
		'app'
	]);
	
	// Directive: layout
	module.directive('layout', [
		'$controller',
		'layout',
		'title',
		layoutDirective
	]);
	
	// Service: layout
	module.service('layout', layoutService);
	
	/*
	 * Directive: layout
	 * 
	 * Includes the layout.
	 */
	function layoutDirective($controller, layout, title) {
		/*
		 * Returns the directive's options.
		 */
		function getOptions() {
			return {
				link: link,
				restrict: 'A',
				scope: {},
				template: '<span ng-include="layout.getTemplateUrl()"></span>'
			};
		}
		
		/*
		 * Invoked during the linking phase.
		 */
		function link(scope) {
			// TODO: comments
			scope.$watch(layout.getControllerName, function(controllerName) {
				// Loads the layout's controller
				var controller = $controller(controllerName);// TODO: should destroyed the current controller?
				
				// Sets the title of the document
				title.set(controller.getTitle());
				
				// Binds the controller to the scope
				scope.layout = controller; 
			});
		}
		
		// Gets and returns the directive's options
		return getOptions();
	}
	
	/*
	 * Service: layout
	 * 
	 * TODO: comments
	 */
	function layoutService() {
		var service = this;
		
		/*
		 * TODO: comments
		 */
		var controllerName;
		
		/*
		 * TODO: comments
		 */
		service.getControllerName = function() {
			return controllerName;
		};
		
		/*
		 * TODO: comments
		 */
		service.setControllerName = function(newControllerName) {
			controllerName = newControllerName;
		};
	}
})();
