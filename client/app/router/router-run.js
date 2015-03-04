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
		'view',
		run
	]);
	
	/**
	 * Performs module-initialization tasks.
	 */
	function run($rootScope, $state, authentication, error, layout, view) {
		// Listens for state transitions
		$rootScope.$on('$stateChangeSuccess', updateLayoutAndView);
		
		// Listens for changes in the authentication state
		$rootScope.$watch(authentication.isStateRefreshing, updateLayoutAndView);
		
		// Listens for changes in the error state
		$rootScope.$watch(error.occurred, updateLayoutAndView);
		
		/**
		 * Updates the layout and the view.
		 */
		function updateLayoutAndView() {
			// Gets the data of the current route
			var data = $state.current.data;
			
			if (angular.isUndefined(data)) {
				// The route has not been established yet
				return;
			}
			
			// Updates the layout
			layout.update();
			
			// Updates the view
			view.update(data.views);
		}
	}
})();
