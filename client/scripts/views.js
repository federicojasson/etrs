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
				link: link,
				restrict: 'A',
				scope: {},
				template: '<span ng-include="view.getTemplateUrl()"></span>'
			};
		}
		
		/*
		 * Invoked during the linking phase.
		 */
		function link(scope) {
			// TODO: comments
			scope.$watch(view.getControllerName, function(controllerName) {
				// Loads the view's controller
				var controller = $controller(controllerName);// TODO: should destroyed the current controller?
				
				// Sets the title of the document
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
	 * TODO: comments
	 */
	function viewService() {
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
