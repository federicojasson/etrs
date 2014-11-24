// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: inputs
	var module = angular.module('inputs');
	
	// Directive: datepickerInput
	module.directive('datepickerInput', [
		'$filter',
		datepickerInputDirective
	]);
	
	/*
	 * Directive: datepickerInput
	 * 
	 * Includes a datepicker input.
	 */
	function datepickerInputDirective($filter) {
		var options = {
			link: link,
			restrict: 'A',
			scope: {
				model: '='
			},
			templateUrl: 'templates/inputs/datepicker-input.html'
		};
		
		/*
		 * TODO
		 */
		function link(scope) {
			// TODO: comments
			scope.date = scope.model.value;
			
			scope.$watch('date', function(date) {
				scope.model = $filter('date')(date, 'yyyy-MM-dd');
			});
		}
		
		return options;
	}
})();
