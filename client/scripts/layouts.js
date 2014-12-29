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
			// Listens for changes in the name of the layout controller
			scope.$watch(layout.getControllerName, function(controllerName) {
				// Loads the layout's controller
				var controller = $controller(controllerName);
				
				// Sets the title of the page
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
	 * Offers functions to change the active layout.
	 */
	function layoutService() {
		var service = this;
		
		/*
		 * The name of the controller which is loaded with the layout.
		 */
		var controllerName;
		
		/*
		 * Returns the name of the layout controller.
		 */
		service.getControllerName = function() {
			return controllerName;
		};
		
		/*
		 * Sets the name of the layout controller.
		 * 
		 * It receives the controller name.
		 */
		service.setControllerName = function(newControllerName) {
			controllerName = newControllerName;
		};
	}
})();
