(function() {
	var module = angular.module('etrs', ['patients', 'utilities']);
	
	module.controller('DateInputController', ['specializedFilter', function(specializedFilter) {
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
	});
})();
