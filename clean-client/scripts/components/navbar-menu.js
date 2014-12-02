// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: components
	var module = angular.module('components');
	
	// Controller: NavbarMenuController
	module.controller('NavbarMenuController', [
		'authentication',
		NavbarMenuController
	]);
	
	// Directive: navbarMenu
	module.directive('navbarMenu', navbarMenuDirective);
	
	/*
	 * Controller: NavbarMenuController
	 * 
	 * Offers functions for the navbar menu.
	 */
	function NavbarMenuController(authentication) {
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
	}
	
	/*
	 * Directive: navbarMenu
	 * 
	 * Includes the navbar menu.
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
