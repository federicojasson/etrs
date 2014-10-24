// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections', [ 'users' ]);
	
	// Controllers
	module.controller('NavigationBarSectionController', [ 'authenticationManager', NavigationBarSectionController ]);
	
	// Directives
	module.directive('footerSection', footerSectionDirective);
	module.directive('navigationBarSection', navigationBarSectionDirective);
	module.directive('viewSection', viewSectionDirective);
	
	/*
	 * Controller: NavigationBarSectionController.
	 * 
	 * Offers functions to logically assist in the rendering of the navigation
	 * bar section.
	 */
	function NavigationBarSectionController(authenticationManager) {
		var controller = this;
		
		/*
		 * Determines whether the log in button should be displayed.
		 */
		controller.showLogInButton = function() {
			return ! authenticationManager.isUserLoggedIn();
		};
	};
	
	/*
	 * Directive: footerSection.
	 * 
	 * Includes the footer section.
	 */
	function footerSectionDirective() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/sections/footer-section.html'
		};
		
		return options;
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
	
	/*
	 * Directive: viewSection.
	 * 
	 * Includes the view section.
	 */
	function viewSectionDirective() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/sections/view-section.html'
		};
		
		return options;
	};
})();
