// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: inputs
	var module = angular.module('inputs');
	
	// Directive: radioButtonsInput
	module.directive('radioButtonsInput', radioButtonsInputDirective);
	
	/*
	 * Directive: radioButtonsInput
	 * 
	 * Includes a radio-buttons input.
	 */
	function radioButtonsInputDirective() {
		var options = {
			restrict: 'A',
			scope: {
				model: '=',
				name: '@',
				options: '='
			},
			templateUrl: 'templates/inputs/radio-buttons-input.html'
		};
		
		return options;
	}
})();
