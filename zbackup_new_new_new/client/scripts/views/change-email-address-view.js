// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ChangeEmailAddressViewController
	module.controller('ChangeEmailAddressViewController', [
		'views',
		ChangeEmailAddressViewController
	]);
	
	/*
	 * Controller: ChangeEmailAddressViewController
	 * 
	 * Offers functions for the change email address view.
	 */
	function ChangeEmailAddressViewController(views) {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return views.selectTemplateUrlOrRedirect({
				ad: 'templates/views/change-email-address-view.html',
				dr: 'templates/views/change-email-address-view.html',
				op: 'templates/views/change-email-address-view.html'
			});
		};
	}
})();
