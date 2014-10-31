// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Controllers
	module.controller('NavigationBarSectionController', [ 'authenticationManager', NavigationBarSectionController ]);
	
	// Directives
	module.directive('navigationBarSection', navigationBarSectionDirective);
	
	/*
	 * Controller: NavigationBarSectionController.
	 * 
	 * Offers logic functions for the navigation bar section.
	 */
	function NavigationBarSectionController(authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the user to show in the navigation bar.
		 */
		controller.getUser = function() {
			// The user to show in the navigation bar is the logged in one
			return authenticationManager.loggedInUser;
		};
		
		/*
		 * Determines whether the log in area should be included.
		 */
		controller.includeLogInArea = function() {
			if (authenticationManager.isRefreshing) {
				// The authentication manager is refreshing its state
				return false;
			}
			
			// Includes the area if the user is not logged in
			return ! authenticationManager.isUserLoggedIn();
		};
		
		/*
		 * Determines whether the user area should be included.
		 */
		controller.includeUserArea = function() {
			if (authenticationManager.isRefreshing) {
				// The authentication manager is refreshing its state
				return false;
			}
			
			// Includes the area if the user is logged in
			return authenticationManager.isUserLoggedIn();
		};
	};
	
	/*
	 * Directive: navigationBarSection.
	 * 
	 * Includes the navigation bar section.
	 */
	function navigationBarSectionDirective() {
		var options = {
			controller: 'NavigationBarSectionController',
			controllerAs: 'section',
			restrict: 'E',
			templateUrl: 'templates/sections/navigation-bar-section.html'
		};
		
		return options;
	};
})();
