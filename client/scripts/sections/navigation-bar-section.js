// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Directives
	module.directive('navigationBarSection', navigationBarSectionDirective);
	
	/*
	 * Directive: navigationBarSection.
	 * 
	 * Includes the navigation bar section.
	 */
	function navigationBarSectionDirective() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/sections/navigation-bar-section.html'
		};
		
		return options;
	};
})();
