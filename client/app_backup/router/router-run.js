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
	angular.module('app.router').run([
		'$rootScope',
		'$state',
		'authentication',
		'error',
		'layout',
		'router',
		'view',
		run
	]);
	
	/**
	 * TODO: comment
	 */
	function run($rootScope, $state, authentication, error, layout, router, view) {
		// Listens for state transitions
		$rootScope.$on('$stateChangeSuccess', updateViewAndLayout);
		
		// Listens for changes in the authentication service
		$rootScope.$watch(authentication.isReady, updateViewAndLayout);
		
		// Listens for changes in the error service
		$rootScope.$watch(error.occurred, updateViewAndLayout);
		
		/**
		 * TODO: comment
		 */
		function updateLayout() {
			// Determines what controller must be loaded
			var controller;
			if (error.occurred()) {
				// An error occurred
				controller = 'ErrorLayoutController';
			} else {
				// No error occurred
				if (authentication.isReady()) {
					// The authentication service is ready
					controller = 'SiteLayoutController';
				} else {
					// The authentication service is not ready
					controller = 'LoadingLayoutController';
				}
			}
			
			// Sets the controller
			layout.setController(controller);
		}
		
		/**
		 * TODO: comment
		 */
		function updateView() {
			if (! authentication.isReady()) {
				// The authentication service is not ready
				return;
			}
			
			// Gets the user role
			var userRole;
			if (authentication.isUserSignedIn()) {
				// The user is signed in
				userRole = authentication.getSignedInUser().role;
			} else {
				// The user is not signed in
				userRole = '__';
			}
			
			// Gets the current route's controllers
			var controllers = $state.current.controllers;
			
			if (! controllers.hasOwnProperty(userRole)) {
				// The user is not authorized to access the current route
				
				// Redirects the user to the root route
				router.redirect('/');
				
				return;
			}
			
			// Gets the controller that must be loaded
			var controller = controllers[userRole];
			
			// Sets the controller
			view.setController(controller);
		}
		
		/**
		 * TODO: comment
		 */
		function updateViewAndLayout() {
			if (angular.isUndefined($state.current.controllers)) {
				// The route has not been established yet
				return;
			}
			
			// Updates the view
			updateView();
			
			// Updates the layout
			updateLayout();
		}
	}
})();
