// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ChangeEmailAddressViewController
	module.controller('ChangeEmailAddressViewController', ChangeEmailAddressViewController);
	
	/*
	 * Controller: ChangeEmailAddressViewController
	 * 
	 * Offers functions for the change email address view.
	 */
	function ChangeEmailAddressViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/change-email-address-view.html';
		};
	}
})();
