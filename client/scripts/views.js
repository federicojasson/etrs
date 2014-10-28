// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views', [ 'ngRoute' ]);
	
	// Configuration
	module.config([ '$routeProvider', configuration ]);
	
	/*
	 * Defines the view associated with each route.
	 * For some views, it also loads controllers to perform further tasks.
	 */
	function configuration($routeProvider) {
		/*
		 * Route: '/'.
		 * View: index.
		 */
		$routeProvider.when('/', {
			controller: 'IndexViewController',
			controllerAs: 'view',
			templateUrl: 'templates/views/index-view.html'
		});
		
		/*
		 * Route: '/contact'.
		 * View: contact.
		 */
		$routeProvider.when('/contact', {
			controller: 'ContactViewController',
			controllerAs: 'view',
			templateUrl: 'templates/views/contact-view.html'
		});
		
		/*
		 * Route: '/help'.
		 * View: help.
		 */
		$routeProvider.when('/help', {
			controller: 'HelpViewController',
			controllerAs: 'view',
			templateUrl: 'templates/views/help-view.html'
		});
		
		/*
		 * Route: '/log-in'.
		 * View: log-in.
		 */
		$routeProvider.when('/log-in', {
			controller: 'LogInViewController',
			controllerAs: 'view',
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		/*
		 * Default action: redirect the user to the root route.
		 */
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	};
})();
