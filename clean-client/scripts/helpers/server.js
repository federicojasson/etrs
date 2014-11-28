// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: server
	module.service('server', [
		'communicator',
		serverService
	]);
	
	/*
	 * Service: server
	 * 
	 * Exposes the server API.
	 * 
	 * All requests to the server should be done through this service.
	 */
	function serverService(communicator) {
		var service = this;
	}
})();
