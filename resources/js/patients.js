(function() {
	var module = angular.module('patients', []);
	
	module.controller('GenderInputController', function() {
		this.options = [
			{ label: 'Se desconoce', value: null },
			{ label: 'Femenino', value: 'F' },
			{ label: 'Masculino', value: 'M' }
		];
		
		this.selectedOption = this.options[0];
		
		this.get = function() {
			return this.selectedOption.value;
		};
		
		this.set = function(value) {
			// TODO
			for (var i = 0; i < this.options.length; i++) {
				var option = this.options[i];
				if (value === option.value)
					this.selectedOption = option;
			}
		};
	});
	
	module.controller('NameInputController', function() {
		this.text = '';
		
		this.get = function() {
			return this.text; // TODO: filter
		};
		
		this.set = function(value) {
			// TODO
			this.text = value;
		};
	});
	
	module.controller('YearsOfEducationInputController', function() {
		this.text = '';
		
		this.get = function() {
			return this.text;
		};
		
		this.set = function(value) {
			// TODO
			this.text = value;
		};
	});
	
	module.controller('PatientController', function() {
		// TODO
		this.background = {};
		this.data = {
			gender: 'M',
			name: 'Prueba',
			yearsOfEducation: 4,
			test: null // TODO
		};
		this.medications = {};
	});
})();

