// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views', [
		'managers',
		'ngRoute'
	]);
	
	// Config
	module.config([
		'$routeProvider',
		config
	]);
	
	// Controllers
	module.controller('ViewController', [
		'viewManager',
		ViewController
	]);
	
	// Directives
	module.directive('view', viewDirective);
	
	/*
	 * Defines the routing.
	 */
	function config($routeProvider) {
		// Dependencies
		var dependencies = {
			'authenticationManager': [
				'authenticationManager',
				function(authenticationManager) {
					return authenticationManager.getPromise();
				}
			],
			'contentManager': [
				'contentManager',
				function(contentManager) {
					return contentManager.getPromise();
				}
			]
		};
		
		// Route: /
		$routeProvider.when('/', {
			accessPolicy: 'ALL_USERS',
			resolve: dependencies,
			templateUrls: {
				anonymous: 'templates/views/index-view/anonymous.html',
				doctor: 'templates/views/index-view/doctor.html',
				operator: 'templates/views/index-view/operator.html',
				researcher: 'templates/views/index-view/researcher.html'
			}
		});
		
		// Route: /about
		$routeProvider.when('/about', {
			accessPolicy: 'ALL_USERS',
			resolve: dependencies,
			templateUrl: 'templates/views/about-view.html'
		});
		
		// Route: /contact
		$routeProvider.when('/contact', {
			accessPolicy: 'ALL_USERS',
			resolve: dependencies,
			templateUrl: 'templates/views/contact-view.html'
		});
		
		// Route: /error
		$routeProvider.when('/error', {
			accessPolicy: 'ALL_USERS',
			resolve: dependencies,
			templateUrl: 'templates/views/error-view.html'
		});
		
		// Route: /fatal-error
		$routeProvider.when('/fatal-error', {
			accessPolicy: 'ALL_USERS',
			templateUrl: 'templates/views/fatal-error-view.html'
		});
		
		// Route: /help
		$routeProvider.when('/help', {
			accessPolicy: 'ALL_USERS',
			resolve: dependencies,
			templateUrls: {
				anonymous: 'templates/views/help-view/anonymous.html',
				doctor: 'templates/views/help-view/doctor.html',
				operator: 'templates/views/help-view/operator.html',
				researcher: 'templates/views/help-view/researcher.html'
			}
		});
		
		// Route: /log-in
		$routeProvider.when('/log-in', {
			accessPolicy: 'ONLY_NOT_LOGGED_IN_USERS',
			resolve: dependencies,
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		// Route: /privacy
		$routeProvider.when('/privacy', {
			accessPolicy: 'ALL_USERS',
			resolve: dependencies,
			templateUrl: 'templates/views/privacy-view.html'
		});
		
		// Route: /tasks
		$routeProvider.when('/tasks', {
			accessPolicy: 'ONLY_LOGGED_IN_USERS',
			resolve: dependencies,
			templateUrl: 'templates/views/tasks-view.html'
		});
		
		// Route: /user/:userId
		$routeProvider.when('/user/:userId', {
			accessPolicy: 'ONLY_LOGGED_IN_USERS',
			resolve: dependencies,
			templateUrl: 'templates/views/user-view.html'
		});
		
		// There is no matching route: it redirects the user to the root route
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	}
	
	/*
	 * Controller: ViewController.
	 * 
	 * Offers logic functions for the view.
	 */
	function ViewController(viewManager) {
		var controller = this;
		
		/*
		 * Returns the URL of the template to be included as the view.
		 */
		controller.getTemplateUrl = function() {
			return viewManager.getTemplateUrl();
		};
	}
	
	/*
	 * Directive: view.
	 * 
	 * Includes the view.
	 */
	function viewDirective() {
		var options = {
			controller: 'ViewController',
			controllerAs: 'view',
			restrict: 'A',
			scope: {},
			template: '<span ng-include="view.getTemplateUrl()"></span>'
		};
		
		return options;
	}
})();
