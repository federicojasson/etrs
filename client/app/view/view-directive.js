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
		'view',
		viewDirective
	]);
	
	/**
	 * Includes the current view.
	 */
	function viewDirective($controller, view) {
		// Returns the settings of the directive
		return getSettings();
		
		/**
		 * Returns the settings of the directive.
		 */
		function getSettings() {
			return {
				restrict: 'A',
				scope: {},
				templateUrl: 'app/view/view.html',
				link: registerViewListener
			};
		}
		
		/**
		 * Registers a listener for the view.
		 * 
		 * Receives the scope of the directive.
		 */
		function registerViewListener(scope) {
			// Listens for changes in the view
			scope.$watch(view.get, function(view) {
				// Initializes the controller
				var controller = $controller(view);
				
				// TODO: register title listener here? otherwise assign controller directly to scope variable
				
				// Binds the controller to the scope of the directive
				scope.view = controller;
			});
		}
	}
})();
