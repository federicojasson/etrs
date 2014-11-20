// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('TasksViewController', [
		'authenticationManager',
		'contentManager',
		TasksViewController
	]);
	
	/*
	 * Controller: TasksViewController.
	 * 
	 * Offers logic functions for the tasks view.
	 */
	function TasksViewController(authenticationManager, contentManager) {
		var controller = this;
		
		/*
		 * Returns the user task groups.
		 */
		controller.getTaskGroups = function() {
			// Gets the logged in user's role
			var userRole = authenticationManager.getLoggedInUser().getRole();
			
			// Returns its task groups
			return contentManager.getTaskGroups(userRole);
		};
	}
})();
