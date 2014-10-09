(function() {
	var module = angular.module('filters', ['services']);
	module.filter('gender', genderFilter);
	module.filter('month', monthFilter);
	module.filter('name', ['stringProcessor', nameFilter]);
	module.filter('noYes', noYesFilter);
	
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
	 * Predefined values: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ].
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
	 * Name filter.
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
})();
