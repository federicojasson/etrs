// Uses strict mode in the whole script
'use strict';

(function() {
	// Creates the module
	var module = angular.module('components', []);
	
	// Creates the module directives
	module.directive('footerSection', footerSectionDirective);
	module.directive('navigationBar', navigationBarDirective);
	module.directive('viewSection', viewSectionDirective);
	
	/*
	 * Directive: footerSection.
	 * 
	 * Includes the site's footer section.
	 */
	function footerSectionDirective() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/components/footer-section.html'
		};
		
		return options;
	};
	
	/*
	 * Directive: navigationBar.
	 * 
	 * Includes the site's navigation bar.
	 */
	function navigationBarDirective() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/components/navigation-bar.html'
		};
		
		return options;
	};
	
	/*
	 * Directive: viewSection.
	 * 
	 * Includes the site's view section.
	 */
	function viewSectionDirective() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/components/view-section.html'
		};
		
		return options;
	};
})();
