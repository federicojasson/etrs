// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: components
	var module = angular.module('components');
	
	// Controller: NavbarMenuController
	module.controller('NavbarMenuController', [
		'$location',
		'authentication',
		NavbarMenuController
	]);
	
	// Directive navbarMenu
	module.directive('navbarMenu', navbarMenuDirective);
	
	/*
	 * Controller: NavbarMenuController
	 * 
	 * TODO: comments
	 */
	function NavbarMenuController($location, authentication) {
		var controller = this;
		
		/*
		 * Returns the navbar user.
		 */
		controller.getUser = function() {
			// The navbar user is the one that is logged in
			return authentication.getLoggedInUser();
		};
		
		/*
		 * Determines whether the log in area should be included.
		 */
		controller.includeLogInArea = function() {
			// Includes the area if the user is not logged in
			return ! authentication.isUserLoggedIn();
		};
		
		/*
		 * Determines whether the user area should be included.
		 */
		controller.includeUserArea = function() {
			// Includes the area if the user is logged in
			return authentication.isUserLoggedIn();
		};
		
		/*
		 * Event handler executed when the actions button is clicked.
		 */
		controller.onClickActionsButton = function() {
			// Redirects the user to the actions route
			$location.path('/actions');
		};
		
		/*
		 * Event handler executed when the user button is clicked.
		 */
		controller.onClickUserButton = function() {
			// Redirects the user to navbar user route
			$location.path('/user/' + controller.getUser().id);
		};
	}
	
	/*
	 * Directive: navbarMenu
	 * 
	 * TODO
	 */
	function navbarMenuDirective() {
		var options = {
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/components/navbar-menu.html'
		};
		
		return options;
	}
})();
