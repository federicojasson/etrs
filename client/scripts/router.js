// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: router
	var module = angular.module('router', [
		'ui.router'
	]);
	
	// Config
	module.config([
		'$locationProvider',
		'$stateProvider',
		'$urlRouterProvider',
		config
	]);
	
	// Service: router
	module.service('router', [
		'$location',
		routerService
	]);
	
	/*
	 * Configures the module.
	 */
	function config($locationProvider, $stateProvider, $urlRouterProvider) {
		// Activates the HTML5 history API
		$locationProvider.html5Mode(true);
		
		// Defines the states
		var states = [
			{
				name: 'changeEmailAddress',
				definition: {
					url: '/change-email-address',
					viewControllers: {
						__: 'LogInViewController',
						ad: 'ChangeEmailAddressViewController',
						dr: 'ChangeEmailAddressViewController',
						op: 'ChangeEmailAddressViewController'
					}
				}
			},
			
			{
				name: 'changePassword',
				definition: {
					url: '/change-password',
					viewControllers: {
						__: 'LogInViewController',
						ad: 'ChangePasswordViewController',
						dr: 'ChangePasswordViewController',
						op: 'ChangePasswordViewController'
					}
				}
			},
			
			{
				name: 'contact',
				definition: {
					url: '/contact',
					viewControllers: {
						__: 'ContactViewController',
						ad: 'ContactViewController',
						dr: 'ContactViewController',
						op: 'ContactViewController'
					}
				}
			},
			
			{
				name: 'home',
				definition: {
					url: '/',
					viewControllers: {
						__: 'LogInViewController',
						ad: 'HomeViewController',
						dr: 'HomeViewController',
						op: 'HomeViewController'
					}
				}
			},
			
			{
				name: 'logIn',
				definition: {
					url: '/log-in',
					viewControllers: {
						__: 'LogInViewController'
					}
				}
			},
			
			{
				name: 'profile',
				definition: {
					url: '/profile',
					viewControllers: {
						__: 'LogInViewController',
						ad: 'ProfileViewController',
						dr: 'ProfileViewController',
						op: 'ProfileViewController'
					}
				}
			},
			
			{
				name: 'requestPasswordRecovery',
				definition: {
					url: '/request-password-recovery',
					viewControllers: {
						__: 'RequestPasswordRecoveryViewController'
					}
				}
			},
			
			{
				name: 'user',
				definition: {
					url: '/user/{userId:(?!.*[.]{2})(?![.])(?!.*[.]$)[.0-9A-Za-z]{1,32}}',
					viewControllers: {
						__: 'LogInViewController',
						ad: 'UserViewController',
						dr: 'UserViewController',
						op: 'UserViewController'
					}
				}
			}
		];
		
		// Registers the states, applying general configurations first
		for (var i = 0; i < states.length; i++) {
			var state = states[i];
			var definition = state.definition;
			
			// Sets a template to include the layout
			definition.template = '<span layout></span>';
			
			// Registers the state
			$stateProvider.state(state.name, definition);
		}
		
		// Sets the default route
		$urlRouterProvider.otherwise('/');
	}
	
	/*
	 * Service: router
	 * 
	 * Offers functions to perform routing actions.
	 */
	function routerService($location) {
		var service = this;
		
		/*
		 * Redirects the user to a certain route.
		 * 
		 * It receives the redirect route.
		 */
		service.redirect = function(route) {
			$location.path(route);
		};
	}
})();
