// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Directives
	module.directive('tasksMenuSection', tasksMenuSectionDirective);
	
	/*
	 * Directive: tasksMenuSection.
	 * 
	 * Includes the tasks menu section.
	 */
	function tasksMenuSectionDirective() {
		var options = {
			restrict: 'A',
			templateUrl: 'templates/sections/tasks-menu-section.html'
		};
		
		return options;
	}
})();
