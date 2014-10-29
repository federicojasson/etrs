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
	 * Offers logic functions for the navigation bar section.
	 */
	function NavigationBarSectionController(authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the user to show in the navigation bar.
		 */
		controller.getUser = function() {
			return authenticationManager.getLoggedInUser();
		};
		
		/*
		 * Determines whether the log in area should be included.
		 */
		controller.includeLogInArea = function() {
			if (authenticationManager.isBeingRefreshed())
				return false;
			
			return ! authenticationManager.isUserLoggedIn();
		};
		
		/*
		 * Determines whether the log out area should be included.
		 */
		controller.includeLogOutArea = function() {
			if (authenticationManager.isBeingRefreshed())
				return false;
			
			return authenticationManager.isUserLoggedIn();
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
