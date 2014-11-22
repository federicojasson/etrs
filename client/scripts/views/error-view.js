// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('ErrorViewController', [
		'$location',
		'$scope',
		'errorManager',
		ErrorViewController
	]);
	
	/*
	 * Controller: ErrorViewController
	 * 
	 * Offers logic functions for the error view.
	 */
	function ErrorViewController($location, $scope, errorManager) {
		var controller = this;
		
		/*
		 * Returns the occurred error.
		 */
		controller.getOccurredError = function() {
			return errorManager.getOccurredError();
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
