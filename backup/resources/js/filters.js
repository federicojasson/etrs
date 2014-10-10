(function() {
	var module = angular.module('filters', ['services']);
	module.filter('day', dayFilter);
	module.filter('gender', genderFilter);
	module.filter('month', monthFilter);
	module.filter('name', ['stringProcessor', nameFilter]);
	module.filter('noYes', noYesFilter);
	module.filter('nonNegativeNumber', ['stringProcessor', nonNegativeNumberFilter]);
	
	/*
	 * Filter for day values.
	 * Given a value, it returns a proper label.
	 * Predefined values: [ 1-31 ].
	 */
	function dayFilter() {
		return function(value) {
			if (value >= 1 && value <= 31)
				return value.toString();
			
			return 'Se desconoce';
		};
	};
	
	/*
	 * Filter for gender values.
	 * Given a value, it returns a proper label.
	 * Predefined values: [ 'F', 'M' ].
	 */
	function genderFilter() {
		return function(value) {
			switch (value) {
				case 'F' : return 'Femenino';
				case 'M' : return 'Masculino';
				default : return 'Se desconoce';
			}
		};
	};
	
	/*
	 * Filter for month values.
	 * Given a value, it returns a proper label.
	 * Predefined values: [ 1-12 ].
	 */
	function monthFilter() {
		return function(value) {
			switch (value) {
				case 1 : return 'Enero';
				case 2 : return 'Febrero';
				case 3 : return 'Marzo';
				case 4 : return 'Abril';
				case 5 : return 'Mayo';
				case 6 : return 'Junio';
				case 7 : return 'Julio';
				case 8 : return 'Agosto';
				case 9 : return 'Septiembre';
				case 10 : return 'Octubre';
				case 11 : return 'Noviembre';
				case 12 : return 'Diciembre';
				default : return 'Se desconoce';
			}
		};
	};
	
	/*
	 * Filter for names.
	 * Given a string, performs tasks so that the result is a valid name.
	 */
	function nameFilter(stringProcessor) {
		return function(string) {
			var name = string;
			
			// TODO: allow all characters?
			
			name = stringProcessor.trim(name);
			name = stringProcessor.removeMultipleWhitespaces(name);
			name = stringProcessor.toUpperCase(name);
			
			return name;
		};
	};
	
	/*
	 * Filter for no/yes values.
	 * Given a value, it returns a proper label.
	 * Predefined values: [ false, true ].
	 */
	function noYesFilter() {
		return function(value) {
			switch (value) {
				case false : return 'No';
				case true : return 'Sí';
				default : return 'Se desconoce';
			}
		};
	};
	
	/*
	 * Filter for non negative numbers.
	 * Given a string, performs tasks so that the result is a non negative
	 * number.
	 */
	function nonNegativeNumberFilter(stringProcessor) {
		return function(string) {
			var nonNegativeNumber = string;
			
			nonNegativeNumber = stringProcessor.removeNonNumberCharacters(nonNegativeNumber);
			
			return nonNegativeNumber;
		};
	};
})();
