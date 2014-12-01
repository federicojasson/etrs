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
	 * TODO: comments
	 */
	function ActionsSectionController(authentication, contents) {
		var controller = this;
		
		/*
		 * TODO
		 */
		controller.getActions = function() {
			// The available actions depend on the user's role
			switch (authentication.getLoggedInUser().mainData.role) {
				case 'ad': {
					return contents.getAdministratorActions();
				}

				case 'dr': {
					return contents.getDoctorActions();
				}

				case 'op': {
					return contents.getOperatorActions();
				}
			}
		};
	}
})();
