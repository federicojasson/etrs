(function() {
	// Module
	var module = angular.module('utilities', [ 'filters' ]);
	
	// Controllers
	module.controller('DateInputController', DateInputController);
	module.controller('GenderInputController', GenderInputController);
	module.controller('NoYesInputController', NoYesInputController);
	
	// Directives
	module.directive('dateInput', dateInputDirective);
	module.directive('genderInput', genderInputDirective);
	module.directive('inputFormSection', inputFormSectionDirective);
	module.directive('nameInput', [ 'nameFilter', nameInputDirective ]);
	module.directive('noYesInput', noYesInputDirective);
	module.directive('nonNegativeNumberInput', [ 'nonNegativeNumberFilter', nonNegativeNumberInputDirective ]);
	
	// Services
	module.service('stringProcessor', stringProcessorService);
	
	/*
	 * Controller: DateInputController.
	 * Manages the date input. It offers the possible values for the day and the
	 * month. Notice that the former can change dynamically when the month and
	 * year values change.
	 */
	function DateInputController() {
		var controller = this;
		
		/*
		 * Day values.
		 */
		controller.dayValues = [
			'',
			1,
			2,
			3,
			4,
			5,
			6,
			7,
			8,
			9,
			10,
			11,
			12,
			13,
			14,
			15,
			16,
			17,
			18,
			19,
			20,
			21,
			22,
			23,
			24,
			25,
			26,
			27,
			28,
			29,
			30,
			31
		];
		
		/*
		 * Month values
		 */
		controller.monthValues = [
			'',
			1,
			2,
			3,
			4,
			5,
			6,
			7,
			8,
			9,
			10,
			11,
			12
		];
		
		/*
		 * Updates the day values according to the month and year currently set.
		 * This function is called when either of them changes.
		 */
		controller.onModelChange = function(model) {
			// The amount of days
			var count;
			
			switch (model.month) {
				case 1 :
				case 3 :
				case 5 :
				case 7 :
				case 8 :
				case 10 :
				case 12 : {
					// January, March, May, July, August, October, December
					count = 31;
					break;
				}
				case 4 :
				case 6 :
				case 9 :
				case 11 : {
					// April, June, September, November
					count = 30;
					break;
				}
				case 2 : {
					// February
					if (model.year === '') {
						// Year unknown
						count = 29;
						break;
					}
					
					if ((model.year % 4 === 0) && (model.year % 100 !== 0 || model.year % 400 === 0)) {
						// Leap year
						count = 29;
						break;
					}
					
					count = 28;
					break;
				}
				default : {
					// Month unknown
					count = 31;
				}
			}
			
			if (model.day !== '' && model.day > count)
				// The day selected is higher than the acceptable
				model.day = count;
			
			// Clears the dayValues array and fills it with the new values
			controller.dayValues.length = 0;
			controller.dayValues[0] = '';
			for (var i = 1; i <= count; i++)
				controller.dayValues[i] = i;
		};
	};
	
	/*
	 * Controller: GenderInputController.
	 * Manages the gender input. It offers the possible values.
	 */
	function GenderInputController() {
		var controller = this;
		
		/*
		 * Gender values.
		 */
		controller.values = [
			'',
			'F',
			'M'
		];
	};
	
	/*
	 * Controller: NoYesInputController.
	 * Manages the no/yes input. It offers the possible values.
	 */
	function NoYesInputController() {
		var controller = this;
		
		/*
		 * No/Yes values.
		 */
		controller.values = [
			true,
			false,
			''
		];
	};
	
	/*
	 * Directive: dateInput.
	 * Includes a date input.
	 */
	function dateInputDirective() {
		var scope = {
			model: '='
		};
		
		var options = {
			controller: 'DateInputController',
			controllerAs: 'input',
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/date-input.html'
		};
		
		return options;
	};
	
	/*
	 * Directive: genderInput.
	 * Includes a gender input.
	 */
	function genderInputDirective() {
		var scope = {
			model: '='
		};
		
		var options = {
			controller: 'GenderInputController',
			controllerAs: 'input',
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/gender-input.html'
		};
		
		return options;
	};
	
	/*
	 * Directive: inputFormSection.
	 * Allows to add a label to some input content.
	 */
	function inputFormSectionDirective() {
		var scope = {
			label: '@'
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/input-form-section.html',
			transclude: true
		};
		
		return options;
	};
	
	/*
	 * Directive: nameInput.
	 * Converts a text input into a name input.
	 */
	function nameInputDirective(nameFilter) {
		var link = function(scope, element, attributes, ngModel) {
			// Adds the name filter as a parser
			ngModel.$parsers.push(nameFilter);
			
			element.on('blur', function() {
				// Updates the element with the value of the model
				element.val(ngModel.$modelValue);
			});
		};
		
		var options = {
			link: link,
			require: 'ngModel',
			restrict: 'A'
		};
		
		return options;
	};
	
	/*
	 * Directive: noYesInput.
	 * Includes a no/yes input.
	 */
	function noYesInputDirective() {
		var scope = {
			model: '=',
			name: '@'
		};
		
		var options = {
			controller: 'NoYesInputController',
			controllerAs: 'input',
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/no-yes-input.html'
		};
		
		return options;
	};
	
	/*
	 * Directive: nonNegativeNumberInput.
	 * Converts a text input into a non negative number input.
	 */
	function nonNegativeNumberInputDirective(nonNegativeNumberFilter) {
		var link = function(scope, element, attributes, ngModel) {
			// Adds the non negative number filter as a parser
			ngModel.$parsers.push(nonNegativeNumberFilter);
			
			element.on('blur', function() {
				// Updates the element with the value of the model
				element.val(ngModel.$modelValue);
			});
		};
		
		var options = {
			link: link,
			require: 'ngModel',
			restrict: 'A'
		};
		
		return options;
	};
	
	/*
	 * Service: stringProcessor.
	 * Offers functions to process strings.
	 */
	function stringProcessorService() {
		var service = this;
		
		/*
		 * Given a string, it replaces all its consecutive whitespaces by a
		 * single one.
		 */
		service.removeMultipleWhitespaces = function(string) {
			return string.replace(/\s+/g, ' ');
		};
		
		/*
		 * Given a string, it removes all its non numeric characters.
		 */
		service.removeNonNumberCharacters = function(string) {
			return string.replace(/[^0-9]/g, '');
		};
		
		/*
		 * Given a string, it converts its lowercase characters to uppercase.
		 */
		service.toUpperCase = function(string) {
			return string.toUpperCase();
		};
		
		/*
		 * Given a string, it trims it.
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
