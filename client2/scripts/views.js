// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views', [
		'managers',
		'ngRoute'
	]);
	
	// Configuration
	module.config([
		'$routeProvider',
		'TestController',
		config
	]);
	
	/*
	 * Defines the views routing.
	 * For some views, it also loads controllers to perform further tasks.
	 */
	function config($routeProvider, TestController) {
		// Route: '/'
		// View: index
		$routeProvider.when('/', {
			templateUrl: TestController.generate()
		});
		
		// Default action: redirect the user to the root route
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	}
	
	/*
	 * TODO
	 */
	module.controller('TestController', [ 'contentManager', TestController ]);
	function TestController(contentManager) {
		this.generate = function() {
			return function() {
				console.log('templateUrl function');
				
				if (contentManager.isLoading) {
					return 'templates/views/loading-view.html';
				} else {
					return '';
				}
			};
		};
	}
})();
