// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: utilities
	var module = angular.module('utilities');
	
	// Filter: gender
	module.filter('gender', genderFilter);
	
	/*
	 * Filter: gender
	 * 
	 * Given a gender, it returns a descriptive label.
	 */
	function genderFilter() {
		/*
		 * TODO: comments
		 */
		var genderLabels = {
			f: 'Femenino',
			m: 'Masculino'
		};
		
		/*
		 * Filters the gender.
		 * 
		 * It receives the gender.
		 */
		function filter(gender) {
			return genderLabels[gender];
		}
		
		return filter;
	}
})();
