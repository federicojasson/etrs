// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ChangePasswordViewController
	module.controller('ChangePasswordViewController', [
		'views',
		ChangePasswordViewController
	]);
	
	/*
	 * Controller: ChangePasswordViewController
	 * 
	 * Offers functions for the change password view.
	 */
	function ChangePasswordViewController(views) {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return views.selectTemplateUrlOrRedirect({
				ad: 'templates/views/change-password-view.html',
				dr: 'templates/views/change-password-view.html',
				op: 'templates/views/change-password-view.html'
			});
		};
	}
})();
