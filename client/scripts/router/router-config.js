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
	 * TODO: comment
	 */
	function config($locationProvider, $stateProvider, $urlRouterProvider) {
		// Enables the HTML5 history API
		//$locationProvider.html5Mode(true); TODO: weird bug (slashes are encoded in url)
		
		// Sets the default route
		$urlRouterProvider.otherwise('/');
		
		// Gets the states
		var states = getStates();
		
		// Registers the states
		for (var name in states) { if (! states.hasOwnProperty(name)) continue;
			var definition = states[name];
			
			// Sets a template that includes the layout
			definition.template = '<span layout></span>';
			
			// Registers the state
			$stateProvider.state(name, definition);
		}
		
		/**
		 * TODO: comment
		 */
		function getStates() {
			return {
				home: {
					url: '/',
					controllers: {
						__: 'SignInViewController',
						ad: 'HomeViewController',
						dr: 'HomeViewController',
						op: 'HomeViewController'
					}
				},
				
				signIn: {
					url: '/sign-in',
					controllers: {
						__: 'SignInViewController'
					}
				},
				
				manageMedications: {
					url: '/manage-medications',
					controllers: {
						__: 'SignInViewController',
						ad: 'ManageMedicationsViewController'
					}
				},
				
				createMedication: {
					url: '/create-medication',
					controllers: {
						__: 'SignInViewController',
						ad: 'CreateMedicationViewController'
					}
				}
			};
		}
	}
})();
