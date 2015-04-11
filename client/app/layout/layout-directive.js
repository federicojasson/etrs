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
	angular.module('app.layout').directive('layout', [
		'$controller',
		'layout',
		'title',
		layoutDirective
	]);
	
	/**
	 * Includes the layout.
	 */
	function layoutDirective($controller, layout, title) {
		/**
		 * Returns the settings.
		 */
		function getSettings() {
			return {
				restrict: 'E',
				scope: {},
				link: onLink,
				templateUrl: 'app/layout/layout.html'
			};
		}
		
		/**
		 * Invoked after the linking phase.
		 * 
		 * Receives the scope of the directive.
		 */
		function onLink(scope) {
			// Registers a listener
			scope.$watch(layout.get, function(currentLayout) {
				// Initializes the current layout's controller
				var controller = $controller(currentLayout, {
					$scope: scope
				});
				
				// Registers a listener
				scope.$watch(controller.isReady, function() {
					// Updates the title
					updateTitle(controller);
				});
				
				// Includes the controller
				scope.layout = controller;
			});
		}
		
		/**
		 * Updates the title according to the state of the current layout.
		 * 
		 * Receives the current layout's controller.
		 */
		function updateTitle(controller) {
			var newTitle;
			
			if (controller.isReady()) {
				// The layout is ready
				// Gets the title provided by the layout
				newTitle = controller.getTitle();
			} else {
				// The layout is not ready
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
