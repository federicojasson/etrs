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
	angular.module('app.utility.router').config([
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
		$locationProvider.html5Mode(true);
		
		// Sets the default route
		$urlRouterProvider.otherwise('/');
		
		// Gets the states
		var states = getStates();
		
		// Registers the states
		for (var i = 0; i < states.length; i++) {
			var state = states[i];
			
			// Sets a template that includes the layout
			state.definition.template = '<span layout></span>';
			
			// Registers the state
			$stateProvider.state(state.name, state.definition);
		}
		
		/**
		 * TODO: comment
		 */
		function getStates() {
			return [
				{
					name: 'home',
					definition: {
						url: '/',
						controllers: {
							__: 'SignInViewController',
							ad: 'HomeViewController',
							dr: 'HomeViewController',
							op: 'HomeViewController'
						}
					}
				}
			];
		}
	}
})();
