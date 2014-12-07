// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: filters
	var module = angular.module('filters');
	
	// Filter: base64ToHexadecimal
	module.filter('base64ToHexadecimal', base64ToHexadecimalFilter);
	
	/*
	 * Filter: base64ToHexadecimal
	 * 
	 * Given a base64 string, it returns its hexadecimal representation.
	 */
	function base64ToHexadecimalFilter() {
		/*
		 * Filters the input.
		 */
		function filter(input) {
			// Initializes the hexadecimal string
			var hexadecimal = '';
			
			// Converts the input to binary
			var binary = atob(input);
			
			// Fills the hexadecimal string byte by byte
			for (var i = 0; i < binary.length; i++) {
				// Gets the current byte
				var byte = binary.charCodeAt(i);
				
				if (byte < 16) {
					// The byte value is lower than 16: it appends a 0
					hexadecimal += '0';
				}
				
				// Appends the byte's hexadecimal representation
				hexadecimal += byte.toString(16);
			}
			
			return hexadecimal;
		}
		
		return filter;
	}
})();
