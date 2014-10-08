(function() {
	var module = angular.module('utilities', []);
	
	module.service('specializedFilter', ['stringFilter', function(stringFilter) {
		this.getName = function(string) {
			var name = string;
			
			// TODO: fix uppercase caret position
			// TODO: allow all characters?
			
			name = stringFilter.trim(name);
			name = stringFilter.removeMultipleWhitespaces(name);
			name = stringFilter.toUpperCase(name);
			
			return name;
		};
		
		this.getNonNegativeNumber = function(string) {
			var nonNegativeNumber = string;
			
			nonNegativeNumber = stringFilter.trim(nonNegativeNumber);
			nonNegativeNumber = stringFilter.removeNonNumberCharacters(nonNegativeNumber);
			
			return nonNegativeNumber;
		};
	}]);
	
	module.service('stringFilter', function() {
		this.removeMultipleWhitespaces = function(string) {
			return string.replace(/\s+/g, ' ');
		};
		
		this.removeNonNumberCharacters = function(string) {
			return string.replace(/[^0-9]/g, "");
		};
		
		this.toUpperCase = function(string) {
			return string.toUpperCase();
		};
		
		this.trim = function(string) {
			if (String.prototype.trim)
				return string.trim();
			else
				return string.replace(/^\s+|\s+$/g, '');
		};
	});
})();
