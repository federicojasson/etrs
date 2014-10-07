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
		this.patient = {
			background: {
				inputs: {
					dbt: null,
					dyslipidemia: null,
					ect: null,
					heartDisease: null,
					hiv: null,
					htn: null,
					psychiatricTreatment: null,
					relativesWithAlzheimer: null
				},
				setDbtInput: function(dbtInput) {
					this.inputs.dbt = dbtInput;
				},
				setDyslipidemiaInput: function(dyslipidemiaInput) {
					this.inputs.dyslipidemia = dyslipidemiaInput;
				},
				setEctInput: function(ectInput) {
					this.inputs.ect = ectInput;
				},
				setHeartDiseaseInput: function(heartDiseaseInput) {
					this.inputs.heartDisease = heartDiseaseInput;
				},
				setHivInput: function(hivInput) {
					this.inputs.hiv = hivInput;
				},
				setHtnInput: function(htnInput) {
					this.inputs.htn = htnInput;
				},
				setPsychiatricTreatmentInput: function(psychiatricTreatmentInput) {
					this.inputs.psychiatricTreatment = psychiatricTreatmentInput;
				},
				setRelativesWithAlzheimerInput: function(relativesWithAlzheimerInput) {
					this.inputs.relativesWithAlzheimer = relativesWithAlzheimerInput;
				}
			},
			data: {
				inputs: {
					birthDate: null,
					gender: null,
					name: null,
					yearsOfEducation: null
				},
				setBirthDateInput: function(birthDateInput) {
					this.inputs.birthDate = birthDateInput;
				},
				setGenderInput: function(genderInput) {
					this.inputs.gender = genderInput;
				},
				setNameInput: function(nameInput) {
					this.inputs.name = nameInput;
				},
				setYearsOfEducationInput: function(yearsOfEducationInput) {
					this.inputs.yearsOfEducation = yearsOfEducationInput;
				}
			},
			medications: {
				inputs: {
					antidepressants: null,
					antidiabetics: null,
					antihypertensives: null,
					antiplateletsAnticoagulants: null,
					antipsychotics: null,
					benzodiazepines: null,
					hypolipidemics: null,
					levothyroxine: null,
					melatonin: null
				},
				setAntidepressantsInput: function(antidepressantsInput) {
					this.inputs.antidepressants = antidepressantsInput;
				},
				setAntidiabeticsInput: function(antidiabeticsInput) {
					this.inputs.antidiabetics = antidiabeticsInput;
				},
				setAntihypertensivesInput: function(antihypertensivesInput) {
					this.inputs.antihypertensives = antihypertensivesInput;
				},
				setAntiplateletsAnticoagulantsInput: function(antiplateletsAnticoagulantsInput) {
					this.inputs.antiplateletsAnticoagulants = antiplateletsAnticoagulantsInput;
				},
				setAntipsychoticsInput: function(antipsychoticsInput) {
					this.inputs.antipsychotics = antipsychoticsInput;
				},
				setBenzodiazepinesInput: function(benzodiazepinesInput) {
					this.inputs.benzodiazepines = benzodiazepinesInput;
				},
				setHypolipidemicsInput: function(hypolipidemicsInput) {
					this.inputs.hypolipidemics = hypolipidemicsInput;
				},
				setLevothyroxineInput: function(levothyroxineInput) {
					this.inputs.levothyroxine = levothyroxineInput;
				},
				setMelatoninInput: function(melatoninInput) {
					this.inputs.melatonin = melatoninInput;
				}
			}
		};
		
		this.onSubmit = function() {
			// TODO
			console.log('NewPatientFormController.onSubmit');
		};
	});
	
	module.directive('newPatientForm', function() {
		var options = {
			restrict: 'E',
			templateUrl: 'templates/new-patient-form.html'
		};
		
		return options;
	});
	
	module.directive('patientBackgroundFormSection', function() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-background-form-section.html'
		};
		
		return options;
	});
	
	module.directive('patientDataFormSection', function() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-data-form-section.html'
		};
		
		return options;
	});
	
	module.directive('patientMedicationsFormSection', function() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-medications-form-section.html'
		};
		
		return options;
	});
})();

