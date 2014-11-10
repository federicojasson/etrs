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
		'views',
		ViewController
	]);
	
	// Directives
	module.directive('view', viewDirective);
	
	// Services
	module.service('views', [
		'$location',
		'$rootScope',
		'$route',
		'authenticationManager',
		viewsService
	]);
	
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
		
		// Route: /contact
		$routeProvider.when('/contact', {
			accessPolicy: 'ALL_USERS',
			resolve: dependencies,
			templateUrl: 'templates/views/contact-view.html'
		});
		
		// Route: /fatal-error
		$routeProvider.when('/fatal-error', {
			accessPolicy: 'ALL_USERS',
			templateUrl: 'templates/views/fatal-error.html'
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
		
		// Route: /tasks
		$routeProvider.when('/tasks', {
			accessPolicy: 'ONLY_LOGGED_IN_USERS',
			resolve: dependencies,
			templateUrls: {
				doctor: 'templates/views/tasks-view/doctor.html',
				operator: 'templates/views/tasks-view/operator.html',
				researcher: 'templates/views/tasks-view/researcher.html'
			}
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
	function ViewController(views) {
		var controller = this;
		
		/*
		 * Returns the URL of the template to be included as the view.
		 */
		controller.getTemplateUrl = function() {
			return views.getTemplateUrl();
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
	
	/*
	 * Service: views.
	 * 
	 * Offers functions to dynamically select the view for the current route.
	 * The service allows to specify predefined access policies and, taking into
	 * account the requesting user and the state of the application, resolves
	 * the route-view binding.
	 * 
	 * Predefined access policies:
	 * 
	 * - ALL_USERS: allows access to all users.
	 * - ONLY_LOGGED_IN_USERS: allows access only to logged in users.
	 * - ONLY_NOT_LOGGED_IN_USERS: allows access only to not logged in users.
	 * 
	 * If access is forbidden or if a route dependency is rejected, the service
	 * redirects the user to an appropriate route.
	 * 
	 * For this service to work, custom properties must be added when
	 * configuring the $routeProvider object:
	 * 
	 * - accessPolicy: indicates the predefined access policy.
	 * - templateUrls: an optional object containing the template URL for each
	 *   user role (and anonymous, in case she is not logged in).
	 * 
	 * Be aware that the property templateUrl takes precedence over templateUrls
	 * when deciding which view to load.
	 */
	function viewsService($location, $rootScope, $route, authenticationManager) {
		var service = this;
		
		/*
		 * Returns the URL of the template to be included as the view.
		 */
		service.getTemplateUrl = function() {
			if (! isViewReady) {
				// The view is not ready
				return 'templates/views/loading-view.html';
			}
			
			// Gets the current route
			var currentRoute = $route.current;
			
			// Gets the template URL
			var templateUrl = currentRoute.templateUrl;
			
			if (typeof templateUrl !== 'undefined') {
				// A template URL has been specified
				return templateUrl;
			}
			
			// Gets the template URLs
			var templateUrls = currentRoute.templateUrls;
			
			if (! authenticationManager.isUserLoggedIn()) {
				// The user is not logged in
				return templateUrls.anonymous;
			}
			
			// The user is logged in: the template URL depends on her role
			var userRole = authenticationManager.getLoggedInUser().getRole();
			return templateUrls[userRole];
		};
		
		/*
		 * Indicates whether the view is ready to be rendered.
		 */
		var isViewReady = false;
		
		/*
		 * Returns whether the user complies with the access policy. In case she
		 * is not, it redirects her to the appropiate route.
		 */
		function checkAccessPolicyCompliance() {
			// Gets the access policy
			var accessPolicy = $route.current.accessPolicy;
			
			// Takes the proper action according to the policy
			switch (accessPolicy) {
				case 'ALL_USERS': {
					return true;
				}
				
				case 'ONLY_LOGGED_IN_USERS': {
					if (! authenticationManager.isUserLoggedIn()) {
						// The user is not logged in
						$location.path('/log-in');
						
						return false;
					}

					return true;
				}
				
				case 'ONLY_NOT_LOGGED_IN_USERS': {
					if (authenticationManager.isUserLoggedIn()) {
						// The user is logged in
						$location.path('/');
						
						return false;
					}

					return true;
				}
			}
		}
		
		// Listens for errors in the route change
		$rootScope.$on('$routeChangeError', function() {
			// TODO: use error manager?
			// TODO: get server response?
			
			// Fatal error: some essential resources could not be loaded
			$location.path('/fatal-error');
		});
		
		// Listens for changes in the route
		$rootScope.$on('$routeChangeStart', function() {
			isViewReady = false;
		});
		
		// Listens for the completion of the route change
		$rootScope.$on('$routeChangeSuccess', function() {
			if (checkAccessPolicyCompliance()) {
				// The access policy is met
				isViewReady = true;
			}
		});
	}
})();
