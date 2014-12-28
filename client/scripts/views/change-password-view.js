// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ChangePasswordViewController
	module.controller('ChangePasswordViewController', ChangePasswordViewController);
	
	/*
	 * Controller: ChangePasswordViewController
	 * 
	 * Offers functions for the change password view.
	 */
	function ChangePasswordViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/change-password-view.html';
		};
	}
})();
