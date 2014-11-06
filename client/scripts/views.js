// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views', [
		'managers',
		'ngRoute'
	]);
	
	// Configuration
	module.config([
		'$routeProvider',
		config
	]);
	
	// Controllers
	module.controller('ViewAccessController', [
		'$location',
		'$route',
		'$scope',
		'authenticationManager',
		ViewAccessController
	]);
	
	/*
	 * Defines the routing.
	 */
	function config($routeProvider) {
		var dependencies = {
			'authenticationManager': ['authenticationManager', function(authenticationManager) {
				return authenticationManager.getWhenReady();
			}]
		}
		
		// Route: /
		$routeProvider.when('/', {
			config: {
				accessPolicy: 'ALL_USERS',
				templateUrls: {
					anonymous: 'templates/views/index-view/anonymous.html',
					doctor: 'templates/views/index-view/doctor.html',
					operator: 'templates/views/index-view/operator.html',
					researcher: 'templates/views/index-view/researcher.html'
				}
			},
			controller: 'ViewAccessController',
			controllerAs: 'view',
			resolve: dependencies,
			templateUrl: 'templates/views/index-view.html'
		});
		
		// Route: /contact
		$routeProvider.when('/contact', {
			resolve: dependencies,
			templateUrl: 'templates/views/contact-view.html'
		});
		
		// Route: /help
		$routeProvider.when('/help', {
			config: {
				accessPolicy: 'ALL_USERS',
				templateUrls: {
					anonymous: 'templates/views/help-view/anonymous.html',
					doctor: 'templates/views/help-view/doctor.html',
					operator: 'templates/views/help-view/operator.html',
					researcher: 'templates/views/help-view/researcher.html'
				}
			},
			controller: 'ViewAccessController',
			controllerAs: 'view',
			resolve: dependencies,
			templateUrl: 'templates/views/help-view.html'
		});
		
		// Route: /log-in
		$routeProvider.when('/log-in', {
			config: {
				accessPolicy: 'ONLY_NOT_LOGGED_IN_USERS',
			},
			controller: 'ViewAccessController',
			controllerAs: 'view',
			resolve: dependencies,
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		// Route: /tasks
		$routeProvider.when('/tasks', {
			config: {
				accessPolicy: 'ONLY_LOGGED_IN_USERS',
				templateUrls: {
					doctor: 'templates/views/tasks-view/doctor.html',
					operator: 'templates/views/tasks-view/operator.html',
					researcher: 'templates/views/tasks-view/researcher.html'
				}
			},
			controller: 'ViewAccessController',
			controllerAs: 'view',
			resolve: dependencies,
			templateUrl: 'templates/views/tasks-view.html'
		});
		
		// There is no matching route: it redirects the user to the root route
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	}
	
	/*
	 * Controller: ViewAccessController.
	 * 
	 * Offers functions to dynamically select a view's template, depending on
	 * the user who is requesting it.
	 * 
	 * This controller was designed to bind a view with a template in cases in
	 * which a more complex logic is necessary. The controller allows to specify
	 * predefined access policies and, taking into account the requesting user,
	 * resolves the view-template binding.
	 * 
	 * Predefined access policies:
	 * 
	 * - ALL_USERS: allows access to all users.
	 * - ONLY_LOGGED_IN_USERS: allows access only to logged in users.
	 * - ONLY_NOT_LOGGED_IN_USERS: allows access only to not logged in users.
	 * 
	 * If access is forbidden, the controller redirects the user to an
	 * appropriate route.
	 * 
	 * When this controller is used, a config property must be added to the
	 * $route object, with the following structure:
	 * 
	 *	config: {
	 *		accessPolicy: ...,
	 *		templateUrls: {
	 *			anonymous: ...,
	 *			doctor: ...,
	 *			operator: ...,
	 *			researcher: ...
	 *		}
	 *	}
	 *	
	 *	Each property of templateUrls must be a string indicating the URL of the
	 *	template to be rendered, according to the requesting user's role
	 *	(or anonymous, if she is not logged in).
	 *	
	 *	The templateUrls property is unnecessary for the
	 *	ONLY_NOT_LOGGED_IN_USERS policy. For the ONLY_LOGGED_IN_USERS access
	 *	policy, the anonymous template URL is not necessary, since not logged in
	 *	users are forbidden.
	 */
	function ViewAccessController($location, $route, $scope, authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the URL of the template to be included in the view.
		 */
		controller.getTemplateUrl = function() {
			if (routeIsChanging) {
				// The route is changing
				return;
			}
			
			// Gets the template URLs
			var templateUrls = $route.current.config.templateUrls;
			
			if (! authenticationManager.isUserLoggedIn()) {
				// The user is not logged in
				return templateUrls.anonymous;
			}
			
			// The user is logged in: the template URL depends on her role
			switch (authenticationManager.getLoggedInUser().getRole()) {
				case 'DR' : {
					// The user is a doctor
					return templateUrls.doctor;
				}
				
				case 'OP' : {
					// The user is an operator
					return templateUrls.operator;
				}
				
				case 'RS' : {
					// The user is a researcher
					return templateUrls.researcher;
				}
			}
		};
		
		/*
		 * Indicates whether the route is changing.
		 * 
		 * It is necessary to monitor changes in the route because the
		 * controller's logic depends on parameters of the $route service.
		 */
		var routeIsChanging = false;
		
		/*
		 * Checks if the requesting user complies with the access policy. In
		 * case she is not, it redirects her to the appropiate route.
		 */
		function checkAccessPolicyCompliance() {
			// Gets the access policy
			var accessPolicy = $route.current.config.accessPolicy;
			
			// Takes the proper action according to the policy
			switch (accessPolicy) {
				case 'ALL_USERS': {
					return;
				}
				
				case 'ONLY_LOGGED_IN_USERS': {
					if (! authenticationManager.isUserLoggedIn()) {
						// The user is not logged in
						$location.path('/log-in');
					}

					return;
				}
				
				case 'ONLY_NOT_LOGGED_IN_USERS': {
					if (authenticationManager.isUserLoggedIn()) {
						// The user is logged in
						$location.path('/');
					}

					return;
				}
			}
		}
		
		// Listens for changes in the route
		$scope.$on('$routeChangeStart', function () {
			routeIsChanging = true;
        });
		
		// Listens for changes in the authentication state
		$scope.$watch(authenticationManager.isUserLoggedIn, function() {
			checkAccessPolicyCompliance();
		});
	}
})();
