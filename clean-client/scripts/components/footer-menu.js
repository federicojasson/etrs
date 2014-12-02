// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: components
	var module = angular.module('components');
	
	// Controller: FooterMenuController
	module.controller('FooterMenuController', [
		'authentication',
		FooterMenuController
	]);
	
	// Directive: footerMenu
	module.directive('footerMenu', footerMenuDirective);
	
	/*
	 * Controller: FooterMenuController
	 * 
	 * Offers functions for the footer menu.
	 */
	function FooterMenuController(authentication) {
		var controller = this;
		
		/*
		 * Determines whether the application area should be included.
		 */
		controller.includeApplicationArea = function() {
			// Includes the area if the user is logged in
			return authentication.isUserLoggedIn();
		};
	}
	
	/*
	 * Directive: footerMenu
	 * 
	 * Includes the footer menu.
	 */
	function footerMenuDirective() {
		var options = {
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/components/footer-menu.html'
		};
		
		return options;
	}
})();
