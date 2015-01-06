// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: inputs
	var module = angular.module('inputs');
	
	// Directive: dateInput
	module.directive('dateInput', dateInputDirective);
	
	/*
	 * Directive: dateInput
	 * 
	 * TODO: comments
	 */
	function dateInputDirective() {
		/*
		 * Returns the directive's options.
		 */
		function getOptions() {
			return {
				link: onLink,
				restrict: 'A',
				scope: {},
				templateUrl: 'templates/inputs/date-input.html'
			};
		}
		
		/*
		 * Invoked during the linking phase.
		 */
		function onLink(scope) {
			// TODO: implement
			/*// Listens for changes in the name of the view controller
			scope.$watch(view.getControllerName, function(controllerName) {
				// Loads the view's controller
				var controller = $controller(controllerName);
				
				// Sets the title of the page
				title.set(controller.getTitle());
				
				// Binds the controller to the scope
				scope.view = controller; 
			});*/
		}
		
		// Gets and returns the directive's options
		return getOptions();
	}
})();
