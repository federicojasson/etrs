// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('ErrorViewController', [
		'$location',
		'errorManager',
		ErrorViewController
	]);
	
	/*
	 * Controller: ErrorViewController.
	 * 
	 * Offers logic functions for the error view.
	 */
	function ErrorViewController($location, errorManager) {
		var controller = this;
		
		/*
		 * Returns the error that occurred.
		 */
		controller.getError = function() {
			return errorManager.error;
		};
		
		/*
		 * Determines whether the view is ready to be rendered.
		 * If no error occurred, it redirects the user to the index view.
		 */
		controller.isReady = function() {
			if (! errorManager.errorOccurred()) {
				// There was no error
				$location.path('/');
				return false;
			}
			
			return true;
		};
	}
})();
