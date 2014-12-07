// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Controllers
	module.controller('AuthenticationSectionController', [
		'$location',
		'authenticationManager',
		'contentManager',
		AuthenticationSectionController
	]);
	
	// Directives
	module.directive('authenticationSection', authenticationSectionDirective);
	
	/*
	 * Controller: AuthenticationSectionController.
	 * 
	 * Offers logic functions for the authentication section.
	 */
	function AuthenticationSectionController($location, authenticationManager, contentManager) {
		var controller = this;
		
		/*
		 * Returns the logged in user.
		 */
		controller.getLoggedInUser = function() {
			return authenticationManager.getLoggedInUser();
		};
		
		/*
		 * Returns the user task groups.
		 */
		controller.getTaskGroups = function() {
			// Gets the logged in user's role
			var userRole = authenticationManager.getLoggedInUser().getRole();
			
			// Returns its task groups
			return contentManager.getTaskGroups(userRole);
		};
		
		/*
		 * Redirects the user to the logged in user route.
		 */
		controller.goToLoggedInUserRoute = function() {
			// Gets the logged in user's ID
			var userId = authenticationManager.getLoggedInUser().getId();
			
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
	 * Directive: authenticationSection.
	 * 
	 * Includes the authentication section.
	 */
	function authenticationSectionDirective() {
		var options = {
			controller: 'AuthenticationSectionController',
			controllerAs: 'section',
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/sections/authentication-section.html'
		};
		
		return options;
	}
})();
