// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Controllers
	module.controller('NavbarMenuSectionController', [
		'$location',
		'authenticationManager',
		'contentManager',
		NavbarMenuSectionController
	]);
	
	// Directives
	module.directive('navbarMenuSection', navbarMenuSectionDirective);
	
	/*
	 * Controller: NavbarMenuSectionController
	 * 
	 * Offers logic functions for the navbar menu section.
	 */
	function NavbarMenuSectionController($location, authenticationManager, contentManager) {
		var controller = this;
		
		/*
		 * Returns the logged in user.
		 */
		controller.getLoggedInUser = function() {
			return authenticationManager.getLoggedInUser();
		};
		
		/*
		 * Returns the user tasks.
		 */
		controller.getTasks = function() {
			// Gets the logged in user's role
			var userRole = authenticationManager.getLoggedInUser().data.role;
			
			// Returns its tasks
			return contentManager.getTasks()[userRole];
		};
		
		/*
		 * Redirects the user to the logged in user route.
		 */
		controller.goToLoggedInUserRoute = function() {
			// Gets the logged in user's ID
			var userId = authenticationManager.getLoggedInUser().data.id;
			
			// TODO: ruta no definida aun
			// Redirects the user to the user route
			$location.path('/user/' + userId);
		};
		
		/*
		 * Redirects the user to the tasks route.
		 */
		controller.goToTasksRoute = function() {
			// Redirects the user to the tasks route
			$location.path('/tasks');
		};
		
		/*
		 * Determines whether the log in area should be included.
		 */
		controller.includeLogInArea = function() {
			// Includes the area if the user is not logged in
			return ! authenticationManager.isUserLoggedIn();
		};
		
		/*
		 * Determines whether the logged in user area should be included.
		 */
		controller.includeLoggedInUserArea = function() {
			// Includes the area if the user is logged in
			return authenticationManager.isUserLoggedIn();
		};
	}
	
	/*
	 * Directive: navbarMenuSection
	 * 
	 * Includes the navbar menu section.
	 */
	function navbarMenuSectionDirective() {
		var options = {
			controller: 'NavbarMenuSectionController',
			controllerAs: 'section',
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/sections/navbar-menu-section.html'
		};
		
		return options;
	}
})();
