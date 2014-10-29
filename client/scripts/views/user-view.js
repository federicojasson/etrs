// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('views');
	
	// Controllers
	module.controller('UserViewController', [ '$routeParams', UserViewController ]);
	
	/*
	 * Controller: UserViewController.
	 * 
	 * Offers logic functions for the user view.
	 */
	function UserViewController($routeParams) {
		var controller = this;
		
		// TODO
	};
})();
