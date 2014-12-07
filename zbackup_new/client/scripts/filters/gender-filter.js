// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: filters
	var module = angular.module('filters');
	
	// Filter: gender
	module.filter('gender', genderFilter);
	
	/*
	 * Filter: gender
	 * 
	 * Given a gender, it returns a descriptive label.
	 */
	function genderFilter() {
		/*
		 * Filters the input.
		 */
		function filter(input) {
			switch (input) {
				case 'f' : {
					return 'Femenino';
				}
				
				case 'm' : {
					return 'Masculino';
				}
			}
		}
		
		return filter;
	}
})();
