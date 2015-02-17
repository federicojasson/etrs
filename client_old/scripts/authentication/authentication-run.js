// Uses strict mode in the whole script
'use strict';

(function() {
	angular.module('app.authentication').run([
		'authentication',
		run
	]);
	
	/*
	 * Performs module initialization tasks.
	 */
	function run(authentication) {
		// Refreshes the authentication state
		authentication.refreshState();
	}
})();
