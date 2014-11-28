// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: app
	var module = angular.module('app', [
		'helpers',
		'ui.bootstrap',
		'ui.router'
	]);
	
	// Config
	module.config([
		'$locationProvider',
		'$stateProvider',
		'$urlRouterProvider',
		config
	]);
	
	// Run
	module.run([
		'authenticator',
		run
	]);
	
	// Controller: RoutingController
	module.controller('RoutingController', [
		'$location',
		'$state',
		'authenticator',
		RoutingController
	]);
	
	/*
	 * Applies application-wide configurations.
	 */
	function config($locationProvider, $stateProvider, $urlRouterProvider) {
		// Activates the HTML5 history API
		$locationProvider.html5Mode(true);
		
		// Defines the default route
		$urlRouterProvider.otherwise('/');
		
		// Defines the template used to include the views in functional states
		var inclusionTemplate = '<span ui-view></span>';
		
		
		// State: off-site
		
		$stateProvider.state('off-site', {
			abstract: true,
			templateUrl: 'templates/layouts/off-site-layout.html'
		});
		
		
		// State: site
		
		$stateProvider.state('site', {
			abstract: true,
			resolve: {
				'authenticator': [
					'authenticator',
					function(authenticator) {
						return authenticator.getPromise();
					}
				]
			},
			templateUrl: 'templates/layouts/site-layout.html'
		});
		
		
		// State: site.actions
		
		$stateProvider.state('site.actions', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/actions'
		});
		
		$stateProvider.state('site.actions.administrator', {
			templateUrl: 'templates/views/actions-view.html'
		});
		
		$stateProvider.state('site.actions.anonymous', {
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		$stateProvider.state('site.actions.doctor', {
			templateUrl: 'templates/views/actions-view.html'
		});
		
		$stateProvider.state('site.actions.operator', {
			templateUrl: 'templates/views/actions-view.html'
		});
		
		
		// State: site.change-password
		
		$stateProvider.state('site.change-password', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/change-password'
		});
		
		$stateProvider.state('site.change-password.administrator', {
			templateUrl: 'templates/views/change-password-view.html'
		});
		
		$stateProvider.state('site.change-password.doctor', {
			templateUrl: 'templates/views/change-password-view.html'
		});
		
		$stateProvider.state('site.change-password.operator', {
			templateUrl: 'templates/views/change-password-view.html'
		});
		
		
		// State: site.contact
		
		$stateProvider.state('site.contact', {
			templateUrl: 'templates/views/contact-view.html',
			url: '/contact'
		});
		
		
		// State: site.index
		
		$stateProvider.state('site.index', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/'
		});
		
		$stateProvider.state('site.index.administrator', {
			templateUrl: 'templates/views/index-view.html'
		});
		
		$stateProvider.state('site.index.anonymous', {
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		$stateProvider.state('site.index.doctor', {
			templateUrl: 'templates/views/index-view.html'
		});
		
		$stateProvider.state('site.index.operator', {
			templateUrl: 'templates/views/index-view.html'
		});
		
		
		// State: site.log-in
		
		$stateProvider.state('site.log-in', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/log-in'
		});
		
		$stateProvider.state('site.log-in.anonymous', {
			templateUrl: 'templates/views/log-in-view.html'
		});
	}
	
	/*
	 * Performs initialization tasks.
	 */
	function run(authenticator) {
		// Refreshes the authentication state
		authenticator.refreshAuthenticationState();
	}
	
	/*
	 * Controller: RoutingController
	 * 
	 * TODO: comments
	 */
	function RoutingController($location, $state, authenticator) {
		/*
		 * TODO: comments
		 */
		function changeState(state) {
			if ($state.get(state) === null) {
				// The state doesn't exist: redirects the user to the root route
				$location.path('/');
			} else {
				// The state exists
				$state.go(state);
			}
		}
		
		/*
		 * TODO: comments
		 * TODO: change name
		 */
		function route() {
			// TODO: chequear si esta logueado
			var loggedIn = true;
			var role = 'dr';

			if (! loggedIn) {
				// The user is not logged in
				changeState('.anonymous');
				return;
			}

			// The user is logged in: the state transition depends on its role
			switch (role) {
				case 'ad': {
					changeState('.administrator');
					return;
				}

				case 'dr': {
					changeState('.doctor');
					return;
				}

				case 'op': {
					changeState('.operator');
					return;
				}
			}
		}
		
		// TODO: comments
		route();
	}
})();
