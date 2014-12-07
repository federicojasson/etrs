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
			// TODO: CHECK THIS!
			var ageDifMs = Date.now() - new Date(input).getTime();
			var ageDate = new Date(ageDifMs); // miliseconds from epoch
			return Math.abs(ageDate.getUTCFullYear() - 1970);
		}
		
		return filter;
	}
})();
