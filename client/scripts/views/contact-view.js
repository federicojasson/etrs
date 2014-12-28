// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ContactViewController
	module.controller('ContactViewController', ContactViewController);
	
	/*
	 * Controller: ContactViewController
	 * 
	 * Offers functions for the contact view.
	 */
	function ContactViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/contact-view.html';
		};
	}
})();
