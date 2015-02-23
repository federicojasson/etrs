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
	 * TODO: comment
	 */
	function viewDirective($controller, title, view) {
		// Returns the directive's parameters
		return getParameters();
		
		/**
		 * TODO: comment
		 */
		function getParameters() {
			return {
				restrict: 'A',
				scope: {},
				template: '<span ng-include="view.getTemplateUrl()"></span>',
				link: registerControllerListener
			};
		}
		
		/**
		 * TODO: comment
		 */
		function registerControllerListener(scope) {
			// Listens for changes in the controller
			scope.$watch(view.getController, function(controller) {
				// Instantiates the controller
				var instance = $controller(controller);
				
				// Listens for changes in the title made by the controller
				scope.$watch(instance.getTitle, function(newTitle) {
					// Sets the title of the document
					title.set(newTitle);
				});
				
				// Binds the controller to the scope
				scope.view = instance;
			});
		}
	}
})();
