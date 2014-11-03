// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('TasksViewController', [
		'$location',
		'$scope',
		'authenticationManager',
		TasksViewController
	]);
	
	/*
	 * Controller: TasksViewController.
	 * 
	 * Offers logic functions for the tasks view.
	 */
	function TasksViewController($location, $scope, authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the template URL of the view.
		 * The template to use depends on the user's role.
		 */
		controller.getTemplateUrl = function() {
			switch (authenticationManager.loggedInUser.role) {
				case 'DR' : return 'templates/views/tasks/doctor-tasks-view.html';
				case 'OP' : return 'templates/views/tasks/operator-tasks-view.html';
				case 'RS' : return 'templates/views/tasks/researcher-tasks-view.html';
				default : return '';
			}
		};
		
		/*
		 * Determines whether the view is ready to be rendered.
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
})();
