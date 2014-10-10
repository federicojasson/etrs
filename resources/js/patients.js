(function() {
	// Module
	var module = angular.module('patients', []);
	
	// Controllers
	module.controller('PatientFormController', PatientFormController);
	
	// Directives
	module.directive('patientBackgroundFormSection', patientBackgroundFormSectionDirective);
	module.directive('patientBasicDataFormSection', patientBasicDataFormSectionDirective);
	module.directive('patientForm', patientFormDirective);
	module.directive('patientMedicationsFormSection', patientMedicationsFormSectionDirective);
	module.directive('patientSummaryFormSection', patientSummaryFormSectionDirective);
	
	/*
	 * Controller: PatientFormController.
	 * Manages the patient form. It allows to reset it or submit it, in order to
	 * add a new patient or to edit an existing one. Also, handles the different
	 * form sections.
	 */
	function PatientFormController() {
		/*
		 * The form section that is currently being shown.
		 * Sections:
		 * 'patient-background'
		 * 'patient-basic-data'
		 * 'patient-medications'
		 * 'patient-summary'
		 * By default, the initial section is 'patient-basic-data'.
		 */
		this.currentSection = 'patient-basic-data';
		
		/*
		 * Indicates whether the purpose of the form is to add a new patient or
		 * edit an existing one. It is assumed that a new patient is to be
		 * added, unless the function loadPatient is called with a defined ID.
		 */
		this.isNewPatient = true;
		
		/*
		 * The patient model bound to the form. All its fields are initialized
		 * as empty.
		 */
		this.patient = {
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
		
		/*
		 * Determines whether a given section is currently being shown.
		 */
		this.isCurrentSection = function(section) {
			return section === this.currentSection;
		};
		
		/*
		 * If the received patient ID is defined, loads the patient data and
		 * updates the model accordingly.
		 */
		this.loadPatient = function(patientId) {
			if (typeof patientId !== 'undefined') {
				// A patient ID was specified
				
				// The form won't add a new patient to the system
				this.isNewPatient = false;

				// TODO: load patientData from $http and set the model
				console.log('patientId: ' + patientId);
			}
		};
		
		/*
		 * Shows a given section.
		 */
		this.showSection = function(section) {
			this.currentSection = section;
		};
		
		/*
		 * Submits the form. The specific action depends on whether a new
		 * patient is to be added.
		 */
		this.submit = function() {
			if (this.isNewPatient)
				;// TODO: read model and insert using $http
			else
				;// TODO: read model and update using $http
		};
	};
	
	/*
	 * TODO
	 */
	function patientBackgroundFormSectionDirective() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/patient-background-form-section.html'
		};
		
		return options;
	};
	
	/*
	 * TODO
	 */
	function patientBasicDataFormSectionDirective() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/patient-basic-data-form-section.html'
		};
		
		return options;
	};
	
	/*
	 * Directive: patientForm.
	 * Includes a patient form. If an ID is specified, submiting the form will
	 * edit the corresponding patient; otherwise, a new patient will be added.
	 */
	function patientFormDirective() {
		var scope = {
			patientId: '@'
		};
		
		var options = {
			controller: 'PatientFormController',
			controllerAs: 'form',
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/patient-form.html'
		};
		
		return options;
	};
	
	/*
	 * TODO
	 */
	function patientMedicationsFormSectionDirective() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/patient-medications-form-section.html'
		};
		
		return options;
	};
	
	/*
	 * TODO
	 */
	function patientSummaryFormSectionDirective() {
		var scope = {
			form: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/patient-summary-form-section.html'
		};
		
		return options;
	};
})();
