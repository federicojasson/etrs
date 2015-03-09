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
	angular.module('app.view').service('view', [
		'$state',
		'authentication',
		'router',
		viewService
	]);
	
	/**
	 * Manages the view.
	 */
	function viewService($state, authentication, router) {
		var _this = this;
		
		/**
		 * The view.
		 */
		var view = '';
		
		/**
		 * Returns the view.
		 */
		_this.get = function() {
			return view;
		};
		
		/**
		 * Updates the view.
		 */
		_this.update = function() {
			// Gets the data of the current route
			var data = $state.current.data;
			
			if (angular.isUndefined(data)) {
				// The route has not been established yet
				return;
			}
			
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
			
			// Gets the views defined in the current route
			var views = data.views;
			
			if (! views.hasOwnProperty(userRole)) {
				// There is no view defined for the user role
				
				// Redirects the user to the home route
				router.redirect('/');
				
				return;
			}
			
			// Gets the view corresponding to the user role
			view = views[userRole];
		};
	}
})();
