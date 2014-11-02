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
		 * Indicates whether the redirection condition has been checked.
		 */
		controller.redirectionChecked = false;
		
		/*
		 * Checks whether an error occurred. If it has not, it redirects the
		 * user to the root route.
		 */
		controller.checkRedirection = function() {
			if (! errorManager.errorOccurred()) {
				// There was no error
				$location.path('/');
				return;
			}
			
			// The redirection condition was checked
			controller.redirectionChecked = true;
		};
		
		/*
		 * Returns the error that occurred.
		 */
		controller.getError = function() {
			return errorManager.error;
		};
		
		/*
		 * Determines whether the view is ready to be rendered.
		 */
		controller.isReady = function() {
			return controller.redirectionChecked;
		};
	}
})();
