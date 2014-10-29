// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('LogInViewController', [ '$location', '$scope', 'authenticationManager', LogInViewController ]);
	
	/*
	 * Controller: LogInViewController.
	 * 
	 * Offers logic functions for the log in view.
	 */
	function LogInViewController($location, $scope, authenticationManager) {
		var controller = this;
		
		/*
		 * Determines whether the view is ready to be rendered.
		 */
		controller.isReady = function() {
			return ! authenticationManager.isRefreshing;
		};
		
		/*
		 * Registers a listener to execute when the authentication state
		 * changes. If the user is already logged in, it redirects her to the
		 * root route.
		 */
		$scope.$watch(authenticationManager.isUserLoggedIn, function(isUserLoggedIn) {
			if (isUserLoggedIn) {
				// The user is already logged in
				$location.path('/');
			}
		});
	};
})();
