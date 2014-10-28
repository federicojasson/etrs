// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('authenticationManager', [ 'server', authenticationManagerService ]);
	
	/*
	 * Service: authenticationManager.
	 * 
	 * Offers functions to manage the authentication state.
	 * This service should be used whenever it is necessary to know if the user
	 * is logged in and her information. Also, the refresh function must be
	 * called when the user is logged in or logged out, to keep the client
	 * application synchronized with its corresponding state in the server.
	 */
	function authenticationManagerService(server) {
		// TODO: authentication manager
	};
})();
