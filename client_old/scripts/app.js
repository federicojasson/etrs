// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('app', [
		'forms',
		'inputs',
		'sections',
		'ui.bootstrap',
		'views'
	]);
	
	// Configuration
	module.config([
		'$locationProvider',
		configuration
	]);
	
	/*
	 * Applies application-wide configurations.
	 */
	function configuration($locationProvider) {
		/*
		 * Uses the HTML5 history API. This allows for use of regular URL path
		 * and search segments, instead of their hashbang equivalents. If the
		 * HTML5 history API is not supported by a browser, the service will
		 * fall back to using the hashbang URLs automatically.
		 */
		$locationProvider.html5Mode(true);
	}
})();
