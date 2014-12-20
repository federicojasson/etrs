// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: LogInViewController
	module.controller('LogInViewController', [
		'views',
		LogInViewController
	]);
	
	/*
	 * Controller: LogInViewController
	 * 
	 * Offers functions for the log in view.
	 */
	function LogInViewController(views) {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return views.selectTemplateUrlOrRedirect({
				__: 'templates/views/log-in-view.html'
			});
		};
	}
})();
