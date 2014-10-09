(function() {
	var module = angular.module('services', []);
	module.service('stringProcessor', stringProcessorService);
	
	/*
	 * String processor service.
	 * It offers functions to process strings.
	 */
	function stringProcessorService() {
		var service = this;
		
		/*
		 * Replaces consecutive whitespaces by a single one.
		 */
		service.removeMultipleWhitespaces = function(string) {
			return string.replace(/\s+/g, ' ');
		};
		
		/*
		 * Removes all non-numeric characters.
		 */
		service.removeNonNumberCharacters = function(string) {
			return string.replace(/[^0-9]/g, '');
		};
		
		/*
		 * Converts the lowercase characters to uppercase.
		 */
		service.toUpperCase = function(string) {
			return string.toUpperCase();
		};
		
		/*
		 * Trims the string.
		 */
		service.trim = function(string) {
			if (String.prototype.trim)
				// string.trim() is defined
				return string.trim();
			else
				// string.trim() is undefined; a custom trim is performed
				return string.replace(/^\s+|\s+$/g, '');
		};
	};
})();
