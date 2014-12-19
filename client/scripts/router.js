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
				name: 'home',
				definition: {
					url: '/',
					layoutController: 'SiteLayoutController',
					viewController: 'HomeViewController'
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
