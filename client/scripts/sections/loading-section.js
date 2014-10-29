// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Directives
	module.directive('loadingSection', loadingSectionDirective);
	
	/*
	 * Directive: loadingSection.
	 * 
	 * Includes the loading section.
	 */
	function loadingSectionDirective() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/sections/loading-section.html'
		};
		
		return options;
	};
})();
