/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.utility.age').filter('age', ageFilter);
	
	/**
	 * Returns a person's age.
	 */
	function ageFilter() {
		/**
		 * Applies the filter.
		 * 
		 * Receives the person.
		 */
		function filter(person) {
			if (person === null) {
				// The person is null
				return '';
			}
			
			// Gets the years
			var years = getYears(person);
			
			if (years < 1) {
				// The person has less than 1 year
				return 'Menos de 1 año';
			}
			
			// Builds the age
			var age = '';
			age += years + ' ';
			age += (years === 1)? 'año' : 'años';
			
			return age;
		}
		
		/**
		 * Returns a person's age in years.
		 * 
		 * Receives the person.
		 */
		function getYears(person) {
			// Gets the current Unix time
			var currentTime = Date.now();
			
			// Gets the Unix time corresponding to the birth date
			var birthTime = person.birthDate.getTime();
			
			// Computes a date resulting from the difference of the two times
			var differenceDate = new Date(currentTime - birthTime);
			
			// Calculates the age in years
			// 1970 is the epoch year
			return differenceDate.getUTCFullYear() - 1970;
		}
		
		// ---------------------------------------------------------------------
		
		return filter;
	}
})();
