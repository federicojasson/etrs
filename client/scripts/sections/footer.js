// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('footer', []);
	
	// Directives
	module.directive('footerSection', footerSectionDirective);
	
	/*
	 * Directive: footerSection.
	 * 
	 * Includes the footer section.
	 */
	function footerSectionDirective() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/sections/footer.html'
		};
		
		return options;
	};
})();
