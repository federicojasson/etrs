// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views', [
		'filters',
		'helpers',
		'managers',
		'ngRoute'
	]);
	
	// Config
	module.config([
		'$routeProvider',
		config
	]);
	
	// Controller: ViewController
	module.controller('ViewController', [
		'viewManager',
		ViewController
	]);
	
	// Directive: view
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
			authorizedUserRoles: [
				'ad',
				'dr',
				'op',
				'rs'
			],
			resolve: dependencies,
			templateUrls: {
				ad: 'templates/views/index-view/ad.html',
				dr: 'templates/views/index-view/dr.html',
				op: 'templates/views/index-view/op.html',
				rs: 'templates/views/index-view/rs.html'
			}
		});
		
		// Route: /change-password
		$routeProvider.when('/change-password', {
			authorizedUserRoles: [
				'ad',
				'dr',
				'op',
				'rs'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/change-password-view.html'
		});
		
		// Route: /consultation/:consultationId
		$routeProvider.when('/consultation/:consultationId', {
			authorizedUserRoles: [
				'dr',
				'op'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/consultation-view.html'
		});
		
		// Route: /contact
		$routeProvider.when('/contact', {
			authorizedUserRoles: [
				'__',
				'ad',
				'dr',
				'op',
				'rs'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/contact-view.html'
		});
		
		// Route: /create-consultation/:patientId
		$routeProvider.when('/create-consultation/:patientId', {
			authorizedUserRoles: [
				'dr'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/create-consultation-view.html'
		});
		
		// Route: /create-patient
		$routeProvider.when('/create-patient', {
			authorizedUserRoles: [
				'dr'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/create-patient-view.html'
		});
		
		// Route: /error
		$routeProvider.when('/error', {
			authorizedUserRoles: [
				'__',
				'ad',
				'dr',
				'op',
				'rs'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/error-view.html'
		});
		
		// Route: /fatal-error
		$routeProvider.when('/fatal-error', {
			authorizedUserRoles: [
				'__',
				'ad',
				'dr',
				'op',
				'rs'
			],
			templateUrl: 'templates/views/fatal-error-view.html'
		});
		
		// Route: /help
		$routeProvider.when('/help', {
			authorizedUserRoles: [
				'ad',
				'dr',
				'op',
				'rs'
			],
			resolve: dependencies,
			templateUrls: {
				ad: 'templates/views/help-view/ad.html',
				dr: 'templates/views/help-view/dr.html',
				op: 'templates/views/help-view/op.html',
				rs: 'templates/views/help-view/rs.html'
			}
		});
		
		// Route: /log-in
		$routeProvider.when('/log-in', {
			authorizedUserRoles: [
				'__'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		// Route: /patient/:patientId
		$routeProvider.when('/patient/:patientId', {
			authorizedUserRoles: [
				'dr'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/patient-view.html'
		});
		
		// Route: /search-patient
		$routeProvider.when('/search-patient', {
			authorizedUserRoles: [
				'dr',
				'op'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/search-patient-view.html'
		});
		
		// Route: /tasks
		$routeProvider.when('/tasks', {
			authorizedUserRoles: [
				'ad',
				'dr',
				'op',
				'rs'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/tasks-view.html'
		});
		
		// Route: /user/:userId
		$routeProvider.when('/user/:userId', {
			authorizedUserRoles: [
				'ad',
				'dr',
				'op',
				'rs'
			],
			resolve: dependencies,
			templateUrl: 'templates/views/user-view.html'
		});
		
		// There is no matching route: it redirects the user to the root route
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	}
	
	/*
	 * Controller: ViewController
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
	 * Directive: view
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
