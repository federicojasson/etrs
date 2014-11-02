// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('communications');
	
	// Services
	module.service('communicationHelper', [
		'$resource',
		communicationHelperService
	]);
	
	/*
	 * Service: communicationHelper.
	 * 
	 * Offers functions to perform communication operations.
	 */
	function communicationHelperService($resource) {
		var service = this;
		
		/*
		 * Sends a POST request to a given URL.
		 * It allows to attach input data and execute callback functions to
		 * respond to different events.
		 * 
		 * Callbacks:
		 * - onSuccess: called if the request succeeds.
		 * - onFailure: called if the request fails.
		 */
		service.sendPostRequest = function(url, input, callbacks) {
			// Sends the POST request
			var reference = $resource(url).save(input);
			
			// Registers the callback functions with the promise
			reference.$promise.then(callbacks.onSuccess, callbacks.onFailure);
			
			return reference;
		};
	}
})();
