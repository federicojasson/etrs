// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ContactViewController
	module.controller('ContactViewController', [
		'views',
		ContactViewController
	]);
	
	/*
	 * Controller: ContactViewController
	 * 
	 * Offers functions for the contact view.
	 */
	function ContactViewController(views) {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return views.selectTemplateUrlOrRedirect({
				__: 'templates/views/contact-view.html',
				ad: 'templates/views/contact-view.html',
				dr: 'templates/views/contact-view.html',
				op: 'templates/views/contact-view.html'
			});
		};
	}
})();
