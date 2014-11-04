// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Directives
	module.directive('footerSection', footerSectionDirective);
	
	/*
	 * Directive: footerSection.
	 * 
	 * Includes the footer section.
	 */
	function footerSectionDirective() {
		var options = {
			restrict: 'A',
			templateUrl: 'templates/sections/footer-section.html'
		};
		
		return options;
	}
})();
