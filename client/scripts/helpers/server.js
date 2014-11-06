// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('helpers');
	
	// Services
	module.service('server', [
		'communicator',
		serverService
	]);
	
	/*
	 * Service: server.
	 * 
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through this service.
	 */
	function serverService(communicator) {
		var service = this;
	}
})();
