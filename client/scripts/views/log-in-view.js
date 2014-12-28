// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: LogInViewController
	module.controller('LogInViewController', LogInViewController);
	
	/*
	 * Controller: LogInViewController
	 * 
	 * Offers functions for the log in view.
	 */
	function LogInViewController() {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/log-in-view.html';
		};
	}
})();
