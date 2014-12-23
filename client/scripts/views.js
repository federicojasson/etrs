// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views', [
		'ui.router',
		'authentication',
		'router'
	]);
	
	// Directive: view
	module.directive('view', [
		'$controller',
		'$state',
		viewDirective
	]);
	
	// Service: views
	module.service('views', [
		'authentication',
		'router',
		viewsService
	]);
	
	/*
	 * Directive: view
	 * 
	 * Includes the view.
	 */
	function viewDirective($controller, $state) {
		/*
		 * Returns the directive's options.
		 */
		function getOptions() {
			return {
				link: link,
				scope: {},
				template: '<span ng-include="view.getTemplateUrl()"></span>'
			};
		}
		
		/*
		 * Invoked during the linking phase.
		 */
		function link(scope) {
			// Binds the view's controller to the scope
			scope.view = $controller($state.current.viewController);
		}
		
		// Gets and returns the directive's options
		return getOptions();
	}
	
	/*
	 * Service: views
	 * 
	 * Offers functions for the views.
	 */
	function viewsService(authentication, router) {
		var service = this;
		
		/*
		 * Selects a template URL according to the current authentication state.
		 * If there's no template defined for the requesting user, it redirects
		 * her to the root route.
		 * 
		 * It receives an object containing a property for each user role
		 * authorized to access the view, whose value indicates the URL of the
		 * corresponding template. The special property '__' can be used to
		 * indicate the URL of the template for anonymous users.
		 */
		service.selectTemplateUrlOrRedirect = function(templateUrls) {
			var userRole;
			
			if (authentication.isUserLoggedIn()) {
				// The user is logged in
				userRole = authentication.getLoggedInUser().role;
			} else {
				// The user is not logged in
				userRole = '__';
			}
			
			if (! templateUrls.hasOwnProperty(userRole)) {
				// The user is not authorized to access the view
				
				// Redirects the user to the root route
				router.redirect('/');
				
				return null;
			}
			
			return templateUrls[userRole];
		};
	}
})();
