// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: filters
	var module = angular.module('filters');
	
	// Filter: age
	module.filter('age', ageFilter);
	
	/*
	 * Filter: age
	 * 
	 * Given a birth date, it returns the person's age.
	 */
	function ageFilter() {
		/*
		 * Filters the input.
		 */
		function filter(input) {
			// TODO
			return '22';
		}
		
		return filter;
	}
})();
