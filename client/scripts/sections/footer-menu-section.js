// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: sections
	var module = angular.module('sections');
	
	// Controller: FooterMenuSectionController
	module.controller('FooterMenuSectionController', [
		'authenticationManager',
		FooterMenuSectionController
	]);
	
	// Directive: footerMenuSection
	module.directive('footerMenuSection', footerMenuSectionDirective);
	
	/*
	 * Controller: FooterMenuSectionController
	 * 
	 * Offers logic functions for the footer menu section.
	 */
	function FooterMenuSectionController(authenticationManager) {
		var controller = this;
		
		/*
		 * Determines whether the application area should be included.
		 */
		controller.includeApplicationArea = function() {
			// Includes the area if the user is logged in
			return authenticationManager.isUserLoggedIn();
		};
	}
	
	/*
	 * Directive: footerMenuSection
	 * 
	 * Includes the footer menu section.
	 */
	function footerMenuSectionDirective() {
		var options = {
			controller: 'FooterMenuSectionController',
			controllerAs: 'section',
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/sections/footer-menu-section.html'
		};
		
		return options;
	}
})();
