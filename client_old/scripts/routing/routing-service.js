// Uses strict mode in the whole script
'use strict';

(function() {
	angular.module('app.routing').service('routing', [
		'$location',
		routingService
	]);
	
	/*
	 * Offers functions to perform routing actions.
	 */
	function routingService($location) {
		var service = this;
		
		/*
		 * Redirects the user to a certain route.
		 * 
		 * It receives the route.
		 */
		service.redirect = function(route) {
			$location.path(route);
		};
	}
})();
