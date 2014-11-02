// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('utilities');
	
	// Services
	module.service('stringProcessor', stringProcessorService);
	
	/*
	 * Service: stringProcessor.
	 * 
	 * Offers functions to process strings.
	 */
	function stringProcessorService() {
		var service = this;
		
		/*
		 * Given a string, it trims it.
		 */
		service.trim = function(string) {
			if (String.prototype.trim) {
				// string.trim() is defined
				return string.trim();
			} else {
				// stringa.trim() is undefined, so a custom trim is performed
				// using a regular expression
				return string.replace(/^\s+|\s+$/g, '');
			}
		};
	}
})();
