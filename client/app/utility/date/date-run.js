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
	angular.module('app.utility.date').run([
		'$filter',
		'$http',
		run
	]);
	
	/**
	 * Performs initialization tasks.
	 */
	function run($filter, $http) {
		/**
		 * Filters the dates present in a value.
		 * 
		 * Receives the value, which can be anything: an array, an object, a
		 * date, etc. In the first two cases, the filter is applied recursively.
		 */
		function filterDates(value) {
			if (angular.isArray(value)) {
				// The value is an array
				// Filters the array's elements
				for (var i = 0; i < value.length; i++) {
					value[i] = filterDates(value[i]);
				}
			}
			
			if (angular.isObject(value)) {
				// The value is an object
				// Filters the object's properties
				for (var property in value) {
					if (! value.hasOwnProperty(property)) {
						continue;
					}
					
					value[property] = filterDates(value[property]);
				}
			}
			
			if (value instanceof Date) {
				// The value is a date
				// Filters the value
				value = $filter('date')(value, 'yyyy-MM-dd');
			}
			
			return value;
		}
		
		// ---------------------------------------------------------------------
		
		// Registers a request interceptor
		$http.defaults.transformRequest.unshift(function(data) {
			return filterDates(data);
		});
	}
})();
