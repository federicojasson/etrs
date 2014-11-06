// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('inputs');
	
	// Directives
	module.directive('logInUserId', [
		'inputAdapter',
		'logInUserIdFilter',
		logInUserIdDirective
	]);
	
	/*
	 * Directive: logInUserId.
	 * 
	 * Input to enter a user ID when logging in.
	 */
	function logInUserIdDirective(inputAdapter, logInUserIdFilter) {
		var filters = [
			logInUserIdFilter
		];
		
		var options = {
			link: inputAdapter(filters),
			require: 'ngModel',
			restrict: 'A',
			scope: {}
		};
		
		return options;
	}
})();
