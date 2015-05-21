/**
 * NEU-CO - Neuro-Cognitivo
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
				link: onPostLink,
				templateUrl: 'app/view/view.html'
			};
		}
		
		/**
		 * Invoked after the linking phase.
		 * 
		 * Receives the scope of the directive.
		 */
		function onPostLink(scope) {
			// Registers a listener
			scope.$watch(view.get, function(currentView) {
				// Initializes the current view's controller
				var controller = $controller(currentView, {
					$scope: scope
				});
				
				// Registers a listener
				scope.$watch(controller.isReady, function() {
					// Updates the title
					updateTitle(controller);
				});
				
				// Includes the controller
				scope.view = controller;
			});
		}
		
		/**
		 * Updates the title according to the state of the current view.
		 * 
		 * Receives the current view's controller.
		 */
		function updateTitle(controller) {
			var newTitle;
			
			if (controller.isReady()) {
				// The view is ready
				// Gets the title provided by the view
				newTitle = controller.getTitle();
			} else {
				// The view is not ready
				newTitle = 'Cargando…';
			}
			
			// Sets the title
			title.set(newTitle);
		}
		
		// ---------------------------------------------------------------------
		
		// Gets the settings
		return getSettings();
	}
})();
