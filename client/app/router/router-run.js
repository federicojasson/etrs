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
	 * Performs module-initialization tasks.
	 */
	function run($rootScope, $state, authentication, error, layout, router, view) {
		// Listens for state transitions
		$rootScope.$on('$stateChangeSuccess', updateLayoutAndView);
		
		// Listens for changes in the authentication state
		$rootScope.$watch(authentication.isStateRefreshing, updateLayoutAndView);
		
		// Listens for changes in the error state
		$rootScope.$watch(error.occurred, updateLayoutAndView);
		
		/**
		 * Updates the layout.
		 */
		function updateLayout() {
			// Determines what controller must be loaded for the layout
			var controller;
			if (error.occurred()) {
				// An error has occurred
				controller = 'LayoutErrorController';
			} else {
				// No error has occurred
				if (authentication.isStateRefreshing()) {
					// The authentication state is being refreshed
					controller = 'LayoutLoadingController';
				} else {
					// The authentication state is not being refreshed
					controller = 'LayoutReadyController';
				}
			}
			
			// Sets the controller of the layout
			layout.setController(controller);
		}
		
		/**
		 * Updates the layout and the view.
		 */
		function updateLayoutAndView() {
			if (angular.isUndefined($state.current.controllers)) {
				// The route has not been established yet
				return;
			}
			
			// Updates the layout
			updateLayout();
			
			// Updates the view
			updateView();
		}
		
		/**
		 * Updates the view.
		 */
		function updateView() {
			if (authentication.isStateRefreshing()) {
				// The authentication state is being refreshed
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
			
			// Gets the controllers of the current route
			var controllers = $state.current.controllers;
			
			if (! controllers.hasOwnProperty(userRole)) {
				// The user is not authorized to access the current route
				
				// Redirects the user to the root URL
				router.redirect('/');
				
				return;
			}
			
			// Gets the controller that must be loaded for the view
			var controller = controllers[userRole];
			
			// Sets the controller of the view
			view.setController(controller);
		}
	}
})();
