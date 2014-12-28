// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: RequestPasswordRecoveryViewController
	module.controller('RequestPasswordRecoveryViewController', RequestPasswordRecoveryViewController);
	
	/*
	 * Controller: RequestPasswordRecoveryViewController
	 * 
	 * Offers functions for the request password recovery view.
	 */
	function RequestPasswordRecoveryViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/request-password-recovery-view.html';
		};
	}
})();
