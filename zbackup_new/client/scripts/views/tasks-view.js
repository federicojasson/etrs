// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: TasksViewController
	module.controller('TasksViewController', [
		'authenticationManager',
		'contentManager',
		TasksViewController
	]);
	
	/*
	 * Controller: TasksViewController
	 * 
	 * Offers logic functions for the tasks view.
	 */
	function TasksViewController(authenticationManager, contentManager) {
		var controller = this;
		
		/*
		 * Returns the user tasks.
		 */
		controller.getTasks = function() {
			// Gets the logged in user's role
			var userRole = authenticationManager.getLoggedInUser().data.role;
			
			// Returns its tasks
			return contentManager.getTasks()[userRole];
		};
	}
})();
