// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: FatalErrorViewController
	module.controller('FatalErrorViewController', [
		'$location',
		'$scope',
		'$window',
		'errorManager',
		FatalErrorViewController
	]);
	
	/*
	 * Controller: FatalErrorViewController
	 * 
	 * Offers logic functions for the fatal error view.
	 */
	function FatalErrorViewController($location, $scope, $window, errorManager) {
		var controller = this;
		
		/*
		 * Returns the occurred error.
		 */
		controller.getOccurredError = function() {
			return errorManager.getOccurredError();
		};
		
		/*
		 * Refreshes the page, causing the application to restart.
		 */
		controller.refreshPage = function() {
			$window.location.reload();
		};
		
		// Listens for the error condition
		$scope.$watch(errorManager.errorOccurred, function(errorOccurred) {
			if (! errorOccurred) {
				// No error occurred
				$location.path('/');
			}
		});
	}
})();
