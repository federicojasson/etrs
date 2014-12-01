// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: routing
	var module = angular.module('routing', [
		'helpers',
		'ui.router'
	]);
	
	// Config
	module.config([
		'$stateProvider',
		'$urlRouterProvider',
		config
	]);
	
	// Controller: RoutingController
	module.controller('RoutingController', [
		'$location',
		'$state',
		'authentication',
		RoutingController
	]);
	
	/*
	 * Defines the routing.
	 */
	function config($stateProvider, $urlRouterProvider) {
		// Defines a template used only to include a view
		var inclusionTemplate = '<span ui-view></span>';
		
		// State: offSite
		$stateProvider.state('offSite', {
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
						return authentication.getDeferredTaskPromise();
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
		}).state('site.actions.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		}).state('site.actions.administrator', {
			templateUrl: 'templates/views/actions.html'
		}).state('site.actions.doctor', {
			templateUrl: 'templates/views/actions.html'
		}).state('site.actions.operator', {
			templateUrl: 'templates/views/actions.html'
		});
		
		// State: site.changePassword
		$stateProvider.state('site.changePassword', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/change-password'
		}).state('site.changePassword.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		}).state('site.changePassword.administrator', {
			templateUrl: 'templates/views/change-password.html'
		}).state('site.changePassword.doctor', {
			templateUrl: 'templates/views/change-password.html'
		}).state('site.changePassword.operator', {
			templateUrl: 'templates/views/change-password.html'
		});
		
		// State: site.contact
		$stateProvider.state('site.contact', {
			templateUrl: 'templates/views/contact.html',
			url: '/contact'
		});
		
		// State: site.createExperiment
		$stateProvider.state('site.createExperiment', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/create-experiment'
		}).state('site.createExperiment.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		}).state('site.createExperiment.administrator', {
			templateUrl: 'templates/views/create-experiment.html'
		});
		
		// State: site.createPatient
		$stateProvider.state('site.createPatient', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/create-patient'
		}).state('site.createPatient.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		}).state('site.createPatient.administrator', {
			templateUrl: 'templates/views/create-patient.html'
		}).state('site.createPatient.doctor', {
			templateUrl: 'templates/views/create-patient.html'
		});
		
		// State: site.createUser
		$stateProvider.state('site.createUser', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/create-user'
		}).state('site.createUser.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		}).state('site.createUser.administrator', {
			templateUrl: 'templates/views/create-user.html'
		});
		
		// State: site.home
		$stateProvider.state('site.home', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/'
		}).state('site.home.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		}).state('site.home.administrator', {
			templateUrl: 'templates/views/home.html'
		}).state('site.home.doctor', {
			templateUrl: 'templates/views/home.html'
		}).state('site.home.operator', {
			templateUrl: 'templates/views/home.html'
		});
		
		// State: site.logIn
		$stateProvider.state('site.logIn', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/log-in'
		}).state('site.logIn.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		});
		
		// State: site.searchPatients
		$stateProvider.state('site.searchPatients', {
			controller: 'RoutingController',
			template: inclusionTemplate,
			url: '/search-patients'
		}).state('site.searchPatients.anonymous', {
			templateUrl: 'templates/views/log-in.html'
		}).state('site.searchPatients.administrator', {
			templateUrl: 'templates/views/search-patients.html'
		}).state('site.searchPatients.doctor', {
			templateUrl: 'templates/views/search-patients.html'
		}).state('site.searchPatients.operator', {
			templateUrl: 'templates/views/search-patients.html'
		});
		
		// Default route
		$urlRouterProvider.otherwise('/');
	}
	
	/*
	 * Controller: RoutingController
	 * 
	 * Takes care of the routing for those states in which the view depends on
	 * the requesting user.
	 */
	function RoutingController($location, $state, authentication) {
		/*
		 * The substates, in function of the user roles.
		 */
		var substates = {
			ad: '.administrator',
			dr: '.doctor',
			op: '.operator'
		}
		
		/*
		 * Redirects the user to a substate of the current state, according to
		 * the requesting user.
		 * 
		 * The substate to be set is:
		 * 
		 * - anonymous: if the user is not logged in.
		 * - administrator: if the user is an administrator.
		 * - doctor: if the user is a doctor.
		 * - operator: if the user is an operator.
		 */
		function redirect() {
			if (! authentication.isUserLoggedIn()) {
				// The user is not logged in
				setState('.anonymous');
				return;
			}
			
			// The user is logged in: the state transition depends on her role
			var userRole = authentication.getLoggedInUser().mainData.role;
			setState(substates[userRole]);
		}
		
		/*
		 * Sets a state, if it exists. Otherwise, it redirects the user to the
		 * root route.
		 * 
		 * It receives the state to be set.
		 */
		function setState(state) {
			if ($state.get(state) === null) {
				// The state doesn't exist: redirects the user to the root route
				$location.path('/');
			} else {
				// The state exists
				$state.go(state);
			}
		}
		
		// Redirects the user to the proper state
		redirect();
	}
})();
