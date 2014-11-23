// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts');
	
	// Directive: mainLayout
	module.directive('mainLayout', mainLayoutDirective);
	
	/*
	 * Directive: mainLayout
	 * 
	 * Includes the main layout.
	 */
	function mainLayoutDirective() {
		var options = {
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/layouts/main-layout.html',
			transclude: true
		};
		
		return options;
	}
})();
