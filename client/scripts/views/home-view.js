// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: HomeViewController
	module.controller('HomeViewController', [
		'views',
		HomeViewController
	]);
	
	/*
	 * Controller: HomeViewController
	 * 
	 * Offers functions for the home view.
	 */
	function HomeViewController(views) {
		var controller = this;
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return views.selectTemplateUrlOrRedirect({
				__: 'templates/views/log-in-view.html',
				ad: 'templates/views/home-view.html',
				dr: 'templates/views/home-view.html',
				op: 'templates/views/home-view.html'
			});
		};
	}
})();
