(function() {
	var module = angular.module('patients', []);
	
	/*module.controller('GenderInputController', function() {
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
		this.background = {
			dbt: null,
			dyslipidemia: null,
			ect: null,
			heartDisease: null,
			hiv: null,
			htn: null,
			psychiatricTreatment: null,
			relativesWithAlzheimer: null
		};
		
		this.data = {
			birthDate: '2014-10-06',
			gender: 'M',
			name: 'Prueba',
			yearsOfEducation: 4,
			test: null // TODO
		};
		
		this.medications = {
			antidepressants: null,
			antidiabetics: null,
			antihypertensives: null,
			antiplateletsAnticoagulants: null,
			antipsychotics: null,
			benzodiazepines: null,
			hypolipidemics: null,
			levothyroxine: null,
			melatonin: null
		};
	});*/
	
	module.controller('NewPatientFormController', function() {
		this.inputs = {
			birthDate: null,
			gender: null,
			name: null,
			yearsOfEducation: null
		};
		
		this.onSubmit = function() {
			// TODO
			console.log('NewPatientFormController.onSubmit');
		};
		
		this.setBirthDateInput = function(birthDateInput) {
			this.inputs.birthDate = birthDateInput;
		};
		
		this.setGenderInput = function(genderInput) {
			this.inputs.gender = genderInput;
		};
		
		this.setNameInput = function(nameInput) {
			this.inputs.name = nameInput;
		};
		
		this.setYearsOfEducationInput = function(yearsOfEducationInput) {
			this.inputs.yearsOfEducation = yearsOfEducationInput;
		};
	});
	
	module.directive('newPatientForm', function() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/new-patient-form.html'
		};
		
		return options;
	});
})();

