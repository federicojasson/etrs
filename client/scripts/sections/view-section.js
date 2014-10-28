// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Directives
	module.directive('viewSection', viewSectionDirective);
	
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
