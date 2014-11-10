// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Controllers
	module.controller('AuthenticationSectionController', [
		'$location',
		'authenticationManager',
		AuthenticationSectionController
	]);
	
	// Directives
	module.directive('authenticationSection', authenticationSectionDirective);
	
	/*
	 * Controller: AuthenticationSectionController.
	 * 
	 * Offers logic functions for the authentication section.
	 */
	function AuthenticationSectionController($location, authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the logged in user.
		 */
		controller.getLoggedInUser = function() {
			return authenticationManager.getLoggedInUser();
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
		
		/*
		 * Action executed when the user clicks on the logged in user button.
		 */
		controller.onClickLoggedInUserButton = function() {
			// Gets the logged in user's ID
			var userId = authenticationManager.getLoggedInUser().getId();
			
			// Redirects the user to the user route
			$location.path('/user/' + userId);
		};
		
		/*
		 * Action executed when the user clicks on the tasks button.
		 */
		controller.onClickTasksButton = function() {
			// Redirects the user to the tasks route
			$location.path('/tasks');
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
