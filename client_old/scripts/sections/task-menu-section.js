// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('sections');
	
	// Controllers
	module.controller('TaskMenuSectionController', [
		'$location',
		'authenticationManager',
		TaskMenuSectionController
	]);
	
	// Directives
	module.directive('taskMenuSection', taskMenuSectionDirective);
	
	/*
	 * Controller: TaskMenuSectionController.
	 * 
	 * Offers logic functions for the task menu section.
	 */
	function TaskMenuSectionController($location, authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the template URL of the section.
		 * The template to use depends on the user's role.
		 */
		controller.getTemplateUrl = function() {
			switch (authenticationManager.loggedInUser.role) {
				case 'DR' : return 'templates/sections/task-menu/doctor-task-menu.html';
				case 'OP' : return 'templates/sections/task-menu/operator-task-menu.html';
				case 'RS' : return 'templates/sections/task-menu/researcher-task-menu.html';
				default : return '';
			}
		};
		
		/*
		 * Determines whether the section is ready to be rendered.
		 * If the user is not logged in, it redirects her to the log in view.
		 */
		controller.isReady = function() {
			if (authenticationManager.isRefreshing) {
				// The authentication manager is refreshing its state
				return false;
			}
			
			if (! authenticationManager.isUserLoggedIn()) {
				// The user is not logged in
				$location.path('/log-in');
				return false;
			}
			
			return true;
		};
	}
	
	/*
	 * Directive: taskMenuSection.
	 * 
	 * Includes the task menu section.
	 */
	function taskMenuSectionDirective() {
		var options = {
			controller: 'TaskMenuSectionController',
			controllerAs: 'section',
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/sections/task-menu-section.html'
		};
		
		return options;
	}
})();
