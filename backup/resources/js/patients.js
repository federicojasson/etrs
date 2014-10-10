(function() {
	var module = angular.module('patients', []);
	module.controller('PatientFormController', PatientFormController);
	module.directive('patientBackgroundFormSection', patientBackgroundFormSectionDirective);
	module.directive('patientBasicDataFormSection', patientBasicDataFormSectionDirective);
	module.directive('patientForm', patientFormDirective);
	module.directive('patientMedicationsFormSection', patientMedicationsFormSectionDirective);
	module.directive('patientSummaryFormSection', patientSummaryFormSectionDirective);
	
	/*
	 * Patient form controller.
	 * TODO
	 */
	function PatientFormController() {
		var controller = this;
		
		/*
		 * TODO
		 */
		controller.currentSection = 'patient-basic-data';
		
		/*
		 * TODO
		 */
		controller.isNewPatient = true;
		
		/*
		 * TODO
		 */
		controller.isCurrentSection = function(section) {
			return section === controller.currentSection;
		};
		
		/*
		 * TODO
		 */
		controller.loadPatientData = function(patientId) {
			if (typeof patientId !== 'undefined') {
				// A patient ID was specified
				
				// The form won't add a new patient to the system
				controller.isNewPatient = false;

				// TODO: load patientData from $http and set the model
				console.log('patientId: ' + patientId);
			}
		};
		
		/*
		 * TODO
		 */
		controller.onSubmit = function() {
			if (controller.isNewPatient)
				;// TODO: read model and insert using $http
			else
				;// TODO: read model and update using $http
		};
		
		/*
		 * TODO
		 */
		controller.reset = function() {
			controller.patient = {
				background: {
					dbt: '',
					dyslipidemia: '',
					ect: '',
					heartDisease: '',
					hiv: '',
					htn: '',
					psychiatricTreatment: '',
					relativesWithAlzheimer: ''
				},
				basicData: {
					birthDate: {
						day: '',
						month: '',
						year: ''
					},
					gender: '',
					name: '',
					yearsOfEducation: ''
				},
				medications: {
					antidepressants: '',
					antidiabetics: '',
					antihypertensives: '',
					antiplateletsAnticoagulants: '',
					antipsychotics: '',
					benzodiazepines: '',
					hypolipidemics: '',
					levothyroxine: '',
					melatonin: ''
				}
			};
		};
		
		/*
		 * TODO
		 */
		controller.showSection = function(section) {
			controller.currentSection = section;
		};
		
		// Resets the form
		controller.reset();
	};
	
	/*
	 * Patient background form section directive.
	 * TODO
	 */
	function patientBackgroundFormSectionDirective() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-background-form-section.html'
		};
		
		return options;
	};
	
	/*
	 * Patient basic data form section directive.
	 * TODO
	 */
	function patientBasicDataFormSectionDirective() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-basic-data-form-section.html'
		};
		
		return options;
	};
	
	/*
	 * Patient form directive.
	 * TODO
	 */
	function patientFormDirective() {
		var scope = {
			patientId: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-form.html'
		};
		
		return options;
	};
	
	/*
	 * Patient medications form section directive.
	 * TODO
	 */
	function patientMedicationsFormSectionDirective() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-medications-form-section.html'
		};
		
		return options;
	};
	
	/*
	 * Patient summary form section directive.
	 * TODO
	 */
	function patientSummaryFormSectionDirective() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-summary-form-section.html'
		};
		
		return options;
	};
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*module.directive('patientBackgroundFormSection', function() {
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
	
	module.directive('patientBasicDataFormSection', function() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-basic-data-form-section.html'
		};
		
		return options;
	});
	
	module.directive('patientForm', function() {
		var controller = function() {
			var controller = this;

			controller.currentSection = 'patient-basic-data';

			controller.isNewPatient = true;

			controller.patient = {
				background: {
					dbt: '',
					dyslipidemia: '',
					ect: '',
					heartDisease: '',
					hiv: '',
					htn: '',
					psychiatricTreatment: '',
					relativesWithAlzheimer: ''
				},
				basicData: {
					birthDate: {
						day: '',
						month: '',
						year: ''
					},
					gender: '',
					name: '',
					yearsOfEducation: ''
				},
				medications: {
					antidepressants: '',
					antidiabetics: '',
					antihypertensives: '',
					antiplateletsAnticoagulants: '',
					antipsychotics: '',
					benzodiazepines: '',
					hypolipidemics: '',
					levothyroxine: '',
					melatonin: ''
				}
			};

			controller.isCurrentSection = function(section) {
				return section === controller.currentSection;
			};

			controller.loadPatientData = function(patientId) {
				if (typeof patientId !== 'undefined') {
					controller.isNewPatient = false;

					// TODO: load patientData from $http
					// and set the model

					// TODO
					console.log('PatientFormController.loadPatientData: ' + patientId);
				}
			};

			controller.onSubmit = function() {
				// TODO: read model and update or insert using $http

				if (controller.isNewPatient) {
					// TODO
					console.log('PatientFormController.onSubmit - insert patient');
				} else {
					// TODO
					console.log('PatientFormController.onSubmit - update patient');
				}
			};

			controller.showSection = function(section) {
				controller.currentSection = section;
			};
		};
		
		var scope = {
			patientId: '@'
		};
		
		var options = {
			controller: controller,
			controllerAs: 'form',
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-form.html'
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
	
	module.directive('patientSummaryFormSection', function() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-summary-form-section.html'
		};
		
		return options;
	});*/
	
	/*module.controller('PatientFormController', function() {
		var controller = this;
		
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
				registerDbtInput: function(dbtInput) {
					this.inputs.dbt = dbtInput;
				},
				registerDyslipidemiaInput: function(dyslipidemiaInput) {
					this.inputs.dyslipidemia = dyslipidemiaInput;
				},
				registerEctInput: function(ectInput) {
					this.inputs.ect = ectInput;
				},
				registerHeartDiseaseInput: function(heartDiseaseInput) {
					this.inputs.heartDisease = heartDiseaseInput;
				},
				registerHivInput: function(hivInput) {
					this.inputs.hiv = hivInput;
				},
				registerHtnInput: function(htnInput) {
					this.inputs.htn = htnInput;
				},
				registerPsychiatricTreatmentInput: function(psychiatricTreatmentInput) {
					this.inputs.psychiatricTreatment = psychiatricTreatmentInput;
				},
				registerRelativesWithAlzheimerInput: function(relativesWithAlzheimerInput) {
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
				registerBirthDateInput: function(birthDateInput) {
					this.inputs.birthDate = birthDateInput;
				},
				registerGenderInput: function(genderInput) {
					this.inputs.gender = genderInput;
				},
				registerNameInput: function(nameInput) {
					this.inputs.name = nameInput;
				},
				registerYearsOfEducationInput: function(yearsOfEducationInput) {
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
				registerAntidepressantsInput: function(antidepressantsInput) {
					this.inputs.antidepressants = antidepressantsInput;
				},
				registerAntidiabeticsInput: function(antidiabeticsInput) {
					this.inputs.antidiabetics = antidiabeticsInput;
				},
				registerAntihypertensivesInput: function(antihypertensivesInput) {
					this.inputs.antihypertensives = antihypertensivesInput;
				},
				registerAntiplateletsAnticoagulantsInput: function(antiplateletsAnticoagulantsInput) {
					this.inputs.antiplateletsAnticoagulants = antiplateletsAnticoagulantsInput;
				},
				registerAntipsychoticsInput: function(antipsychoticsInput) {
					this.inputs.antipsychotics = antipsychoticsInput;
				},
				registerBenzodiazepinesInput: function(benzodiazepinesInput) {
					this.inputs.benzodiazepines = benzodiazepinesInput;
				},
				registerHypolipidemicsInput: function(hypolipidemicsInput) {
					this.inputs.hypolipidemics = hypolipidemicsInput;
				},
				registerLevothyroxineInput: function(levothyroxineInput) {
					this.inputs.levothyroxine = levothyroxineInput;
				},
				registerMelatoninInput: function(melatoninInput) {
					if (! controller.isNewPatient)
						melatoninInput.set(controller.patientObject.medications.melatonin); // TODO
					
					this.inputs.melatonin = melatoninInput;
				}
			}
		};
		
		this.isNewPatient = true;
		this.patientObject = null;
		this.section = 'patient-data';
		
		this.initialize = function(patientObject) {
			console.log(patientObject);
			
			patientObject = typeof patientObject !== 'undefined' ? patientObject : null;
			
			if (patientObject === null)
				this.isNewPatient = true;
			else {
				this.isNewPatient = false;
				
				// TODO: clone patientObject?
				this.patientObject = patientObject;
			}
		};
		
		this.isSectionShown = function(section) {
			return this.section === section;
		};
		
		this.onSubmit = function() {
			// TODO
			console.log('PatientFormController.onSubmit');
		};
		
		this.showSection = function(section) {
			this.section = section;
		};
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
	
	module.directive('patientForm', function() {
		var scope = {
			patientObject: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-form.html'
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
	
	module.directive('patientSummaryFormSection', function() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-summary-form-section.html'
		};
		
		return options;
	});*/
})();

