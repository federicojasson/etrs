// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views', [
		'app'
	]);
	
	// Directive: view
	module.directive('view', [
		'$controller',
		'title',
		'view',
		viewDirective
	]);
	
	// Service: view
	module.service('view', viewService);
	
	/*
	 * Directive: view
	 * 
	 * Includes the view.
	 */
	function viewDirective($controller, title, view) {
		/*
		 * Returns the directive's options.
		 */
		function getOptions() {
			return {
				link: onLink,
				restrict: 'A',
				scope: {},
				template: '<span ng-include="view.getTemplateUrl()"></span>'
			};
		}
		
		/*
		 * Invoked during the linking phase.
		 */
		function onLink(scope) {
			// Listens for changes in the name of the view controller
			scope.$watch(view.getControllerName, function(controllerName) {
				// Loads the view's controller
				var controller = $controller(controllerName);
				
				// Sets the title of the page
				title.set(controller.getTitle());
				
				// Binds the controller to the scope
				scope.view = controller; 
			});
		}
		
		// Gets and returns the directive's options
		return getOptions();
	}
	
	/*
	 * Service: view
	 * 
	 * Offers functions to change the active view.
	 */
	function viewService() {
		var service = this;
		
		/*
		 * The name of the controller which is loaded with the view.
		 */
		var controllerName;
		
		/*
		 * Returns the name of the view controller.
		 */
		service.getControllerName = function() {
			return controllerName;
		};
		
		/*
		 * Sets the name of the view controller.
		 * 
		 * It receives the controller name.
		 */
		service.setControllerName = function(newControllerName) {
			controllerName = newControllerName;
		};
	}
})();
