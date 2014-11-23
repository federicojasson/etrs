// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: filters
	var module = angular.module('filters');
	
	// Filter: hexadecimalToBase64
	module.filter('hexadecimalToBase64', hexadecimalToBase64Filter);
	
	/*
	 * Filter: hexadecimalToBase64
	 * 
	 * Given a hexadecimal string, it returns its base64 representation.
	 */
	function hexadecimalToBase64Filter() {
		/*
		 * Filters the input.
		 */
		function filter(input) {
			// Computes the binary bytes in an array
			var binaryBytes = input.replace(/([\da-fA-F]{2}) ?/g, '0x$1 ').replace(/ +$/, '').split(' ');
			
			// Initializes the binary string
			var binary = String.fromCharCode.apply(null, binaryBytes);
			
			// Converts the binary string to base64 and returns it
			return btoa(binary);
		}
		
		return filter;
	}
})();
