// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: utilities
	var module = angular.module('utilities');
	
	// Filter: age
	module.filter('age', ageFilter);
	
	/*
	 * Filter: age
	 * 
	 * Given a birth date, it returns the person's age.
	 */
	function ageFilter() {
		/*
		 * Filters the birth date.
		 * 
		 * It receives the birth date.
		 */
		function filter(birthDate) {
			// TODO: CHECK THIS! (clean code)
			var ageDifMs = Date.now() - new Date(birthDate).getTime();
			var ageDate = new Date(ageDifMs); // miliseconds from epoch
			return Math.abs(ageDate.getUTCFullYear() - 1970);
		}
		
		return filter;
	}
})();
