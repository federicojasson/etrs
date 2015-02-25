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
	angular.module('app.utility').service('utility', utilityService);
	
	/**
	 * TODO: comment
	 */
	function utilityService() {
		var _this = this;
		
		/**
		 * Converts a string from spinal-case to camelCase.
		 * 
		 * Receives the string.
		 */
		_this.toCamelCase = function(string) {
			// Replaces the dashes with whitespaces
			string = string.replace(/-/g, ' ');

			// Converts the first character of each word to uppercase
			string = string.replace(/\b[a-z]/g, function(character) {
				return character.toUpperCase();
			});
			
			// Removes the whitespaces
			string = string.replace(/ /g, '');
			
			// Converts the first character to lowercase
			return string.charAt(0).toLowerCase() + string.slice(1);
		};
	}
})();
