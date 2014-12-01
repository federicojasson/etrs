// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: app
	var module = angular.module('app', [
		'components',
		'helpers',
		'routing',
		'ui.bootstrap'
	]);
	
	// Config
	module.config([
		'$locationProvider',
		config
	]);
	
	// Run
	module.run([
		'authentication',
		run
	]);
	
	/*
	 * Applies application-wide configurations.
	 */
	function config($locationProvider) {
		// Activates the HTML5 history API
		$locationProvider.html5Mode(true);
	}
	
	/*
	 * Performs initialization tasks.
	 */
	function run(authentication) {
		// Refreshes the authentication state
		authentication.refreshState();
	}
})();
