// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: app
	var module = angular.module('app', [
		'components',
		'filters',
		'forms',
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
		'authentication',
		run
	]);
	
	// Controller: RoutingController
	module.controller('RoutingController', [
		'$location',
		'$state',
		'authentication',
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
		
		
		// Defines the states
		
		// Defines a template used only to include a view
		var inclusionTemplate = '<span ui-view></span>';
		
		
		// State: off-site
		
		$stateProvider.state('off-site', {
			abstract: true,
			templateUrl: 'templates/layouts/off-site.html'
		});
		
		
		// State: site
		
		$stateProvider.state('site', {
			abstract: true,
			resolve: {
				'authentication': [
					'authentication',
					function(authentication) {
						return authentication.getPromise();
					}
				]
			},
			templateUrl: 'templates/layouts/site.html'
		});
		
		
		// State: site.actions
		
		$stateProvider.state('site.actions', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/actions'
		});
		
		$stateProvider.state('site.actions.administrator', {
			templateUrl: 'templates/views/actions.html'
		});
		
		$stateProvider.state('site.actions.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		});
		
		$stateProvider.state('site.actions.doctor', {
			templateUrl: 'templates/views/actions.html'
		});
		
		$stateProvider.state('site.actions.operator', {
			templateUrl: 'templates/views/actions.html'
		});
		
		
		// State: site.change-password
		
		$stateProvider.state('site.change-password', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/change-password'
		});
		
		$stateProvider.state('site.change-password.administrator', {
			templateUrl: 'templates/views/change-password.html'
		});
		
		$stateProvider.state('site.change-password.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		});
		
		$stateProvider.state('site.change-password.doctor', {
			templateUrl: 'templates/views/change-password.html'
		});
		
		$stateProvider.state('site.change-password.operator', {
			templateUrl: 'templates/views/change-password.html'
		});
		
		
		// State: site.consultation
		
		// TODO
		$stateProvider.state('site.consultation', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/consultation/'
		});
		
		
		// State: site.contact
		
		$stateProvider.state('site.contact', {
			templateUrl: 'templates/views/contact.html',
			url: '/contact'
		});
		
		
		// State: site.create-patient
		
		$stateProvider.state('site.create-patient', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/create-patient'
		});
		
		$stateProvider.state('site.create-patient.administrator', {
			templateUrl: 'templates/views/create-patient.html'
		});
		
		$stateProvider.state('site.create-patient.doctor', {
			templateUrl: 'templates/views/create-patient.html'
		});
		
		$stateProvider.state('site.create-patient.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		});
		
		
		// State: site.create-user
		
		$stateProvider.state('site.create-user', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/create-user'
		});
		
		$stateProvider.state('site.create-user.administrator', {
			templateUrl: 'templates/views/create-user.html'
		});
		
		$stateProvider.state('site.create-user.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		});
		
		
		// State: site.home
		
		$stateProvider.state('site.home', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/'
		});
		
		$stateProvider.state('site.home.administrator', {
			templateUrl: 'templates/views/home.html'
		});
		
		$stateProvider.state('site.home.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		});
		
		$stateProvider.state('site.home.doctor', {
			templateUrl: 'templates/views/home.html'
		});
		
		$stateProvider.state('site.home.operator', {
			templateUrl: 'templates/views/home.html'
		});
		
		
		// State: site.log-in
		
		$stateProvider.state('site.log-in', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/log-in'
		});
		
		$stateProvider.state('site.log-in.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		});
		
		
		// State: site.patient
		
		// TODO
		$stateProvider.state('site.patient', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/patient/'
		});
		
		
		// State: site.search-patients
		
		$stateProvider.state('site.search-patients', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/search-patients'
		});
		
		$stateProvider.state('site.search-patients.administrator', {
			templateUrl: 'templates/views/search-patients.html'
		});
		
		$stateProvider.state('site.create-patient.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		});
		
		$stateProvider.state('site.search-patients.doctor', {
			templateUrl: 'templates/views/search-patients.html'
		});
		
		$stateProvider.state('site.search-patients.operator', {
			templateUrl: 'templates/views/search-patients.html'
		});
		
		
		// State: site.user
		
		// TODO
		$stateProvider.state('site.user', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/user/'
		});
	}
	
	/*
	 * Performs initialization tasks.
	 */
	function run(authentication) {
		// Refreshes the authentication
		authentication.refresh();
	}
	
	/*
	 * Controller: RoutingController
	 * 
	 * TODO: comments
	 */
	function RoutingController($location, $state, authentication) {
		/*
		 * TODO: comments
		 * TODO: name
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
			if (! authentication.isUserLoggedIn()) {
				// The user is not logged in
				changeState('.anonymous');
				return;
			}

			// The user is logged in: the state transition depends on its role
			switch (authentication.getLoggedInUser().mainData.role) {
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
