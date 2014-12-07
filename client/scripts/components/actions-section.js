// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: components
	var module = angular.module('components');
	
	// Controller: ActionsSectionController
	module.controller('ActionsSectionController', [
		'authentication',
		'contents',
		ActionsSectionController
	]);
	
	/*
	 * Controller: ActionsSectionController
	 * 
	 * Offers functions for the actions section.
	 */
	function ActionsSectionController(authentication, contents) {
		var controller = this;
		
		/*
		 * Returns the logged in user's action set.
		 */
		controller.getActionSet = function() {
			// The action set depends on the user role
			var userRole = authentication.getLoggedInUser().mainData.role;
			return contents.getActionSet(userRole);
		};
	}
})();
