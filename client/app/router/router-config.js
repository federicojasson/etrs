/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.router').config([
		'$locationProvider',
		'$stateProvider',
		'$urlRouterProvider',
		config
	]);
	
	/**
	 * Applies module-related configurations.
	 */
	function config($locationProvider, $stateProvider, $urlRouterProvider) {
		// Enables the HTML5 history API
		//$locationProvider.html5Mode(true); //TODO: weird bug (slashes are encoded in url)
		
		// Sets the URL of the default route
		$urlRouterProvider.otherwise('/');
		
		// Gets the states to be registered
		var states = getStates();
		
		// Registers the states
		for (var i = 0; i < states.length; i++) {
			var state = states[i];
			
			// Prepends a circumflex accent to make the URL absolute
			state.url = '^' + state.url;
			
			// Sets a template that includes the layout
			state.template = '<div layout></div>';
			
			// Registers the state
			$stateProvider.state(state);
		}
		
		/**
		 * Returns the states to be registered.
		 */
		function getStates() {
			return [
				{
					name: 'account',
					url: '/account',
					data: {
						views: {
							__: 'ViewAccountSignInController',
							ad: 'ViewAccountController',
							dr: 'ViewAccountController',
							op: 'ViewAccountController'
						}
					}
				},
				
				{
					name: 'account.resetPassword',
					url: '/account/reset-password/{id:[0-9A-Fa-f]{32}}/{password:[0-9A-Fa-f]{256}}',
					data: {
						views: {
							__: 'ViewAccountResetPasswordController'
						}
					}
				},
				
				{
					name: 'account.resetPassword.request',
					url: '/account/reset-password',
					data: {
						views: {
							__: 'ViewAccountResetPasswordRequestController'
						}
					}
				},
				
				{
					name: 'account.signIn',
					url: '/account/sign-in',
					data: {
						views: {
							__: 'ViewAccountSignInController'
						}
					}
				},
				
				{
					name: 'account.signUp',
					url: '/account/sign-up/{id:[0-9A-Fa-f]{32}}/{password:[0-9A-Fa-f]{256}}',
					data: {
						views: {
							__: 'ViewAccountSignUpController'
						}
					}
				},
				
				{
					name: 'account.signUp.request',
					url: '/account/sign-up',
					data: {
						views: {
							__: 'ViewAccountSignInController',
							ad: 'ViewAccountSignUpRequestController'
						}
					}
				},
				
				{
					name: 'home',
					url: '/',
					data: {
						views: {
							__: 'ViewAccountSignInController',
							ad: 'ViewHomeController',
							dr: 'ViewHomeController',
							op: 'ViewHomeController'
						}
					}
				},
				
				{
					name: 'medication',
					url: '/medication/{id:[0-9A-Fa-f]{32}}',
					data: {
						views: {
							__: 'ViewAccountSignInController',
							ad: 'ViewMedicationController'
						}
					}
				},
				
				{
					name: 'medication.create',
					url: '/medication/create',
					data: {
						views: {
							__: 'ViewAccountSignInController',
							ad: 'ViewMedicationCreateController'
						}
					}
				},
				
				{
					name: 'medication.manage',
					url: '/medication/manage',
					data: {
						views: {
							__: 'ViewAccountSignInController',
							ad: 'ViewMedicationManageController'
						}
					}
				}
			];
		}
	}
})();
