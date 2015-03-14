/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.view').directive('view', [
		'$controller',
		'title',
		'view',
		viewDirective
	]);
	
	/**
	 * Includes the view.
	 */
	function viewDirective($controller, title, view) {
		/**
		 * Returns the settings.
		 */
		function getSettings() {
			return {
				restrict: 'E',
				scope: {},
				link: onLink,
				templateUrl: 'app/view/view.html'
			};
		}
		
		/**
		 * Invoked after the linking phase.
		 * 
		 * Receives the scope of the directive.
		 */
		function onLink(scope) {
			// Registers a listener
			scope.$watch(view.get, function(newView) {
				// Initializes the current view's controller
				var viewController = $controller(newView, {
					$scope: scope
				});
				
				// Registers a listener
				scope.$watch(viewController.getTitle, function() {
					// Updates the title
					updateTitle(viewController);
				});
				
				// Registers a listener
				scope.$watch(viewController.isReady, function() {
					// Updates the title
					updateTitle(viewController);
				});
				
				// Includes the controller
				scope.view = viewController;
			});
		}
		
		/**
		 * Updates the title according to the state of the current view.
		 * 
		 * Receives the view's controller.
		 */
		function updateTitle(viewController) {
			var newTitle;
			
			if (viewController.isReady()) {
				// The view is ready
				// Gets the title provided by the view
				newTitle = viewController.getTitle();
			} else {
				// The view is not ready
				newTitle = 'Cargando...';
			}
			
			// Sets the title
			title.set(newTitle);
		}
		
		// ---------------------------------------------------------------------
		
		// Gets the settings
		return getSettings();
	}
})();
