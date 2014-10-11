(function() {
	// Module
	var module = angular.module('communications', [ 'ngResource' ]);
	
	// Services
	module.service('communicationFacility', [ '$resource', communicationFacilityService ]);
	module.service('server', [ 'communicationFacility', serverService ]);
	
	/*
	 * Service: communicationFacility.
	 * Offers functions to perform several communication operations.
	 */
	function communicationFacilityService($resource) {
		var service = this;
		
		/*
		 * Sends a POST request to a given URL, with certain parameters.
		 * Optionally, it allows the execution of callback functions to respond
		 * to different events.
		 * Callbacks:
		 * onSuccess: called if the request succeeds.
		 * onFailure: called if the request fails.
		 */
		service.sendPostRequest = function(url, parameters, callbacks) {
			var actions = {
				sendRequest: {
					method: 'POST',
					params: parameters
				}
			};
			
			// Sends the request
			var reference = $resource(url, {}, actions).sendRequest();
			
			// Configures the promise
			reference.$promise.then(callbacks.onSuccess, callbacks.onFailure);
			
			return reference;
		};
	};
	
	/*
	 * Service: server.
	 * Exposes the server API. All requests to the server should be done through
	 * this service.
	 */
	function serverService(communicationFacility) {
		var service = this;
		
		/*
		 * TODO
		 */
		service.getPatient = function(patientId, callbacks) {
			var url = 'debug/patients.json';
			
			var parameters = {
				patiendId: patientId
			};
			
			return communicationFacility.sendPostRequest(url, parameters, callbacks);
		};
	};
})();
