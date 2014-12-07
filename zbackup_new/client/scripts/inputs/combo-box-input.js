// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: inputs
	var module = angular.module('inputs');
	
	// Directive: comboBoxInput
	module.directive('comboBoxInput', comboBoxInputDirective);
	
	/*
	 * Directive: comboBoxInput
	 * 
	 * Includes a combo box input.
	 */
	function comboBoxInputDirective() {
		var options = {
			restrict: 'A',
			scope: {
				model: '=',
				options: '='
			},
			templateUrl: 'templates/inputs/combo-box-input.html'
		};
		
		return options;
	}
})();
