// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views', [ 'ngRoute', 'users' ]);
	
	// Configuration
	module.config([ '$routeProvider', configuration ]);
	
	// Controllers
	module.controller('HelpViewController', [ 'authenticationManager', HelpViewController ]);
	module.controller('IndexViewController', [ 'authenticationManager', IndexViewController ]);
	module.controller('LogInViewController', [ 'authenticationManager', '$location', LogInViewController ]);
	
	/*
	 * Defines the view associated with each route.
	 * It also loads controllers to perform further tasks for some views.
	 */
	function configuration($routeProvider) {
		/*
		 * Route: '/'.
		 * View: index.
		 */
		$routeProvider.when('/', {
			controller: 'IndexViewController',
			controllerAs: 'view',
			templateUrl: 'templates/views/index-view.html'
		});
		
		/*
		 * Route: '/help'.
		 * View: help.
		 */
		$routeProvider.when('/help', {
			controller: 'HelpViewController',
			controllerAs: 'view',
			templateUrl: 'templates/views/help-view.html'
		});
		
		/*
		 * Route: '/log-in'.
		 * View: log-in.
		 */
		$routeProvider.when('/log-in', {
			controller: 'LogInViewController',
			controllerAs: 'view',
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		/*
		 * Default action: redirect the user to the root route.
		 */
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	};
	
	/*
	 * Controller: HelpViewController.
	 * 
	 * Determines the appropriate template to render the help view, according to
	 * whether the user is logged in and, if she is, to her role.
	 */
	function HelpViewController(authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the template URL of the view.
		 */
		controller.getTemplateUrl = function() {
			if (! authenticationManager.isUserLoggedIn()) {
				// The user is not logged in
				return 'templates/views/help-view-anonymous.html';
			}
			
			// The user is logged in, so the template URL depends on her role
			switch (authenticationManager.getLoggedInUser().role) {
				case 'DR' : return 'templates/views/help-view-doctor.html';
				case 'OP' : return 'templates/views/help-view-operator.html';
				case 'RS' : return 'templates/views/help-view-researcher.html';
				default : return ''; // TODO: what to do in this case?
			}
		};
	};
	
	/*
	 * Controller: IndexViewController.
	 * 
	 * Determines the appropriate template to render the index view, according
	 * to whether the user is logged in and, if she is, to her role.
	 */
	function IndexViewController(authenticationManager) {
		var controller = this;
		
		/*
		 * Returns the template URL of the view.
		 */
		controller.getTemplateUrl = function() {
			if (! authenticationManager.isUserLoggedIn())
				// The user is not logged in
				return 'templates/views/index-view-anonymous.html';
			
			// The user is logged in, so the template URL depends on her role
			switch (authenticationManager.getLoggedInUser().role) {
				case 'DR' : return 'templates/views/index-view-doctor.html';
				case 'OP' : return 'templates/views/index-view-operator.html';
				case 'RS' : return 'templates/views/index-view-researcher.html';
				default : return ''; // TODO: what to do in this case?
			}
		};
	};
	
	/*
	 * Controller: LogInViewController.
	 * 
	 * Determines if the log in view can be rendered, according to whether the
	 * user is logged in.
	 */
	function LogInViewController(authenticationManager, $location) {
		var controller = this;
		
		/*
		 * Checks whether the user is already logged in and, if she is, it
		 * redirects her to the root route.
		 */
		controller.checkConditions = function() {
			if (authenticationManager.isUserLoggedIn())
				// The user is already logged in
				$location.path('/');
		};
	};
})();
