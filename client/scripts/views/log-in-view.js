// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('LogInViewController', [
		'$location',
		'$scope',
		'authenticationManager',
		LogInViewController
	]);
	
	/*
	 * Controller: LogInViewController.
	 * 
	 * Offers logic functions for the log in view.
	 */
	function LogInViewController($location, $scope, authenticationManager) {
		var controller = this;
		
		/*
		 * Determines whether the view is ready to be rendered.
		 * If the user is already logged in, it redirects her to the index view.
		 */
		controller.isReady = function() {
			if (authenticationManager.isRefreshing) {
				// The authentication manager is refreshing its state
				return false;
			}
			
			if (authenticationManager.isUserLoggedIn()) {
				// The user is already logged in
				$location.path('/');
				return false;
			}
			
			return true;
		};
	}
})();
