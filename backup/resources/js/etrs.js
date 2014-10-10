(function() {
	var module = angular.module('etrs', ['filters', 'patients', 'routes', 'views']);
	module.controller('DateInputController', DateInputController);
	module.controller('GenderInputController', GenderInputController);
	module.controller('NoYesInputController', NoYesInputController);
	module.directive('formInputSection', formInputSectionDirective);
	module.directive('nameInput', ['nameFilter', nameInputDirective]);
	module.directive('noYesInputSection', noYesInputSectionDirective);
	module.directive('nonNegativeNumber', ['nonNegativeNumberFilter', nonNegativeNumberDirective]);
	
	/*
	 * Date input controller.
	 * TODO
	 */
	function DateInputController() {
		var controller = this;
		
		/*
		 * TODO
		 */
		controller.currentMonth = '';
		
		/*
		 * TODO
		 */
		controller.currentYear = '';
		
		/*
		 * TODO
		 */
		controller.dayValues = [];
		
		/*
		 * TODO
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
		 * TODO
		 */
		controller.onMonthChange = function(month) {
			console.log('onMonthChange: ' + month);
		};
		
		/*
		 * TODO
		 */
		controller.onYearChange = function(year) {
			console.log('onYearChange: ' + year);
		};
		
		/*
		 * TODO
		 */
		controller.updateDayValues = function() {
			// TODO: update day values according to currentMonth and currentYear
		};
		
		// Updates the day values
		controller.updateDayValues();
	};
	
	/*
	 * Gender input controller.
	 * TODO
	 */
	function GenderInputController() {
		var controller = this;
		
		/*
		 * TODO
		 */
		controller.values = [
			'',
			'F',
			'M'
		];
	};
	
	/*
	 * No/Yes input controller.
	 * TODO
	 */
	function NoYesInputController() {
		var controller = this;
		
		/*
		 * TODO
		 */
		controller.values = [
			true,
			false,
			''
		];
	};
	
	/*
	 * Form input section directive.
	 * TODO
	 */
	function formInputSectionDirective() {
		var scope = {
			label: '@'
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/form-input-section.html',
			transclude: true
		};
		
		return options;
	};
	
	/*
	 * Name input directive.
	 * TODO
	 */
	function nameInputDirective(nameFilter) {
		var link = function(scope, element, attributes, ngModel) {
			ngModel.$parsers.push(nameFilter);
		};
		
		var options = {
			link: link,
			require: 'ngModel',
			restrict: 'A'
		};
		
		return options;
	};
	
	/*
	 * No/Yes input section directive.
	 * TODO
	 */
	function noYesInputSectionDirective() {
		var scope = {
			model: '=',
			name: '@'
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/no-yes-input-section.html'
		};
		
		return options;
	};
	
	/*
	 * Non negative number directive.
	 * TODO
	 */
	function nonNegativeNumberDirective(nonNegativeNumberFilter) {
		var link = function(scope, element, attributes, ngModel) {
			ngModel.$parsers.push(nonNegativeNumberFilter);
		};
		
		var options = {
			link: link,
			require: 'ngModel',
			restrict: 'A'
		};
		
		return options;
	};
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*module.controller('dayInputController', function() {
		var controller = this;

		controller.values = [
			'',
			1,
			2
		];
	});
	
	module.directive('dayInput', function() {
		var controller = function() {
			var controller = this;
			
			controller.values = [
				'',
				1,
				2
			];
		};
		
		var options = {
			controller: controller,
			controllerAs: 'input',
			restrict:' A'
		};
		
		return options;
	});
	
	module.directive('genderInput', function() {
		var controller = function() {
			var controller = this;
			
			controller.values = [
				'',
				'F',
				'M'
			];
		};
		
		var options = {
			controller: controller,
			controllerAs: 'input',
			restrict: 'A'
		};
		
		return options;
	});
	
	module.directive('monthInput', function() {
		var controller = function() {
			var controller = this;
			
			controller.values = [
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
		};
		
		var options = {
			controller: controller,
			controllerAs: 'input',
			restrict: 'A'
		};
		
		return options;
	});
	
	module.directive('nameInput', ['stringParser', function(stringParser) {
		var link = function(scope, element, attributes, ngModel) {
			ngModel.$parsers.push(stringParser.getName);
		};
		
		var options = {
			link: link,
			require: 'ngModel',
			restrict: 'A'
		};
		
		return options;
	}]);
	
	module.directive('nonNegativeNumberInput', ['stringParser', function(stringParser) {
		var link = function(scope, element, attributes, ngModel) {
			ngModel.$parsers.push(stringParser.getNonNegativeNumber);
		};
		
		var options = {
			link: link,
			require: 'ngModel',
			restrict: 'A'
		};
		
		return options;
	}]);
	
	module.filter('gender', function() {
		return function(value) {
			switch (value) {
				case 'F' : return 'Femenino';
				case 'M' : return 'Masculino';
				default : return 'Se desconoce';
			}
		};
	});
	
	module.filter('month', function() {
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
	});*/
	
	/*module.directive('nameInput', function() {
		var link = function(scope, element, attributes, ngModel) {
			function fromUser(text) {
				console.log('fromUser');
				return (text || '').toUpperCase();
			}
			
			function toUser(text) {
				console.log('toUser');
				return (text || '').toLowerCase();
			}
			
			ngModel.$parsers.push(fromUser);
			ngModel.$formatters.push(toUser);
		};
		
		var options = {
			link: link,
			require: 'ngModel',
			restrict: 'A'
		};
		
		return options;
	});*/
	
	/*module.controller('GenderInputController', function() {
		this.genders = [
			{ label: 'Se desconoce', value: null },
			{ label: 'Femenino', value: 'F' },
			{ label: 'Masculino', value: 'M' }
		];
	});*/
	
	/*module.controller('NameInputController', ['stringParser', function(stringParser) {
		this.filterName = function(name) {
			return stringParser.getName(name);
		};
	}]);*/
	
	/*module.controller('DateInputController', ['specializedFilter', function(specializedFilter) {
		// TODO: maybe use a more smart input controller (that detects month and year)
		
		this.months = [
			{ label: 'Seleccionar mes', value: null },
			{ label: 'Enero', value: 1 },
			{ label: 'Febrero', value: 2 },
			{ label: 'Marzo', value: 3 },
			{ label: 'Abril', value: 4 },
			{ label: 'Mayo', value: 5 },
			{ label: 'Junio', value: 6 },
			{ label: 'Julio', value: 7 },
			{ label: 'Agosto', value: 8 },
			{ label: 'Septiembre', value: 9 },
			{ label: 'Octubre', value: 10 },
			{ label: 'Noviembre', value: 11 },
			{ label: 'Diciembre', value: 12 }
		];
		
		this.day = '';
		this.month = this.months[0];
		this.year = '';
		
		this.onDayChange = function() {
			this.day = specializedFilter.getNonNegativeNumber(this.day);
		};
		
		this.onYearChange = function() {
			this.year = specializedFilter.getNonNegativeNumber(this.year);
		};
	}]);
	
	module.controller('GenderInputController', function() {
		this.genders = [
			{ label: 'Se desconoce', value: null },
			{ label: 'Femenino', value: 'F' },
			{ label: 'Masculino', value: 'M' }
		];
		
		this.gender = this.genders[0];
	});
	
	module.controller('NameInputController', ['specializedFilter', function(specializedFilter) {
		this.name = '';
		
		this.onNameChange = function() {
			this.name = specializedFilter.getName(this.name);
		};
	}]);
	
	module.controller('NonNegativeNumberInputController', ['specializedFilter', function(specializedFilter) {
		this.number = '';
		
		this.onNumberChange = function() {
			this.number = specializedFilter.getNonNegativeNumber(this.number);
		};
	}]);
	
	module.controller('YesNoInputController', function() {
		this.options = [
			{ label: 'Sí', value: true },
			{ label: 'No', value: false },
			{ label: 'Se desconoce', value: null }
		];
		
		this.option = this.options[2];
		
		this.set = function(value) {
			// TODO
			for (var i = 0; i < options.length; i++)
				if (value === options[i].value) {
					this.option = options[i];
					break;
				}
		};
	});*/
})();
