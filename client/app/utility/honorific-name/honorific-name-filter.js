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
	angular.module('app.utility.honorificName').filter('honorificName', honorificNameFilter);
	
	/**
	 * Returns a user's honorific name.
	 */
	function honorificNameFilter() {
		/**
		 * Applies the filter.
		 * 
		 * Receives the user.
		 */
		function filter(user) {
			if (user === null) {
				// The user is null
				return '';
			}
			
			// Gets the honorific title
			var honorificTitle = getHonorificTitle(user);
			
			// Builds the honorific name
			return honorificTitle + ' ' + user.lastName;
		}
		
		/**
		 * Returns a user's honorific title.
		 * 
		 * Receives the user.
		 */
		function getHonorificTitle(user) {
			// Gets the honorific titles
			var honorificTitles = getHonorificTitles();
			
			// Gets the honorific title
			var honorificTitle = honorificTitles[user.role];
			
			if (user.gender === 'f') {
				// The user is a woman
				honorificTitle += 'a';
			}
			
			// Appends a dot
			honorificTitle += '.';
			
			return honorificTitle;
		}
		
		/**
		 * Returns the honorific titles.
		 */
		function getHonorificTitles() {
			return {
				'ad': 'Sr',
				'dr': 'Dr',
				'op': 'Sr'
			};
		}
		
		// ---------------------------------------------------------------------
		
		return filter;
	}
})();
