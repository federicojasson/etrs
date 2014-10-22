// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('user', []);
	
	// Controllers
	module.controller('AuthenticationManagerController', AuthenticationManagerController);
	
	/*
	 * Controller: AuthenticationManager.
	 * TODO
	 */
	function AuthenticationManagerController() {
		var controller = this;
		
		/*
		 * TODO
		 */
		controller.loggedInUser = null;
		
		/*
		 * TODO
		 */
		controller.isUserLoggedIn = function() {
			return controller.loggedInUser !== null;
		};
		
		/*
		 * TODO
		 */
		controller.logInUser = function(user) {
			controller.loggedInUser = user;
		};
		
		/*
		 * TODO
		 */
		controller.logOutUser = function() {
			controller.loggedInUser = null;
		}
	};
})();
