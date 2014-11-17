// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('viewManager', [
		'$location',
		'$rootScope',
		'$route',
		'Error',
		'authenticationManager',
		'errorManager',
		viewManagerService
	]);
	
	/*
	 * Service: viewManager.
	 * 
	 * Offers functions to dynamically select the view for the current route.
	 * The service allows to specify the user roles authorized to access a
	 * certain route and, taking into account the requesting user and the state
	 * of the application, resolves the route-view binding.
	 * 
	 * If access is forbidden or if a route dependency is rejected, the service
	 * redirects the user to an appropriate route.
	 * 
	 * For this service to work, custom properties must be added when
	 * configuring the $routeProvider object:
	 * 
	 * - authorizedUserRoles: an array indicating the user roles authorized to
	 *   access the route.
	 * - templateUrls: an optional object containing the template URL for each
	 *   user role.
	 * 
	 * The special value 'anonymous' can be used to refer to not logged in users
	 * when defining the rules.
	 * 
	 * Be aware that the property templateUrl takes precedence over templateUrls
	 * when deciding which view to load.
	 */
	function viewManagerService($location, $rootScope, $route, Error, authenticationManager, errorManager) {
		var service = this;
		
		/*
		 * Indicates whether the view is ready to be rendered.
		 */
		var isViewReady = false;
		
		/*
		 * Determines whether the user is authorized to access the current
		 * route. In case she is not, it redirects her to the appropiate route.
		 */
		function checkUserAuthorization() {
			// Gets the authorized user roles
			var authorizedUserRoles = $route.current.authorizedUserRoles;
			
			if (! angular.isDefined(authorizedUserRoles)) {
				// No user role has been authorized for the current route
				return false;
			}
			
			if (! authenticationManager.isUserLoggedIn()) {
				// The user is not logged in
				var isAuthorized = authorizedUserRoles.indexOf('anonymous') > -1;
				
				if (! isAuthorized) {
					// Redirects the user to the log in route
					$location.path('/log-in');
				}
				
				return isAuthorized;
			}
			
			// The user is logged in: the decision depends on her role
			var userRole = authenticationManager.getLoggedInUser().getRole();
			var isAuthorized = authorizedUserRoles.indexOf(userRole) > -1;
			
			if (! isAuthorized) {
				// Redirects the user to the root route
				$location.path('/');
			}
			
			return isAuthorized;
		}
		
		/*
		 * Returns the URL of the template to be included as the view.
		 */
		service.getTemplateUrl = function() {
			if (! isViewReady) {
				// The view is not ready
				return 'templates/views/loading-view.html';
			}
			
			// Gets the current route
			var currentRoute = $route.current;
			
			// Gets the template URL
			var templateUrl = currentRoute.templateUrl;
			
			if (angular.isDefined(templateUrl)) {
				// A template URL has been specified
				return templateUrl;
			}
			
			// Gets the template URLs
			var templateUrls = currentRoute.templateUrls;
			
			if (! authenticationManager.isUserLoggedIn()) {
				// The user is not logged in
				return templateUrls.anonymous;
			}
			
			// The user is logged in: the template URL depends on her role
			var userRole = authenticationManager.getLoggedInUser().getRole();
			return templateUrls[userRole];
		};
		
		// Listens for errors in the route change
		$rootScope.$on('$routeChangeError', function() {
			// Fatal error: some essential resources could not be loaded
			var error = Error.createFatalError('No fue posible cargar recursos esenciales para la aplicación.');
			errorManager.reportFatalError(error);
		});
		
		// Listens for changes in the route
		$rootScope.$on('$routeChangeStart', function() {
			isViewReady = false;
		});
		
		// Listens for the completion of the route change
		$rootScope.$on('$routeChangeSuccess', function() {
			if (checkUserAuthorization()) {
				// The access policy is met
				isViewReady = true;
			}
		});
	}
})();
