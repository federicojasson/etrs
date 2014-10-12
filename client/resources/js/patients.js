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
		var controller = this;
		
		/*
		 * The form section that is currently being shown.
		 * Sections:
		 * 'patient-background'
		 * 'patient-basic-data'
		 * 'patient-medications'
		 * 'patient-summary'
		 * By default, the initial section is 'patient-basic-data'.
		 */
		controller.currentSection = 'patient-basic-data';
		
		/*
		 * Indicates whether the purpose of the form is to add a new patient or
		 * to edit an existing one.
		 */
		controller.isNewPatient;
		
		/*
		 * Determines whether a given section is currently being shown.
		 */
		controller.isCurrentSection = function(section) {
			return section === controller.currentSection;
		};
		
		/*
		 * The form patient model.
		 */
		controller.patient = {};
		
		/*
		 * Depending on whether the received patient model is defined,
		 * configures the form to edit a given patient or to add a new one.
		 */
		controller.setPatient = function(patient) {
			if (typeof patient === 'undefined') {
				// The purpose of the form is to add a new patient
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
			} else {
				// The purpose of the form is to edit an existing patient
				controller.isNewPatient = false;
				controller.patient = patient;
			}
		};
		
		/*
		 * Shows a given section.
		 */
		controller.showSection = function(section) {
			controller.currentSection = section;
		};
		
		/*
		 * Submits the form. The specific action depends on whether a new
		 * patient is to be added.
		 */
		controller.submit = function() {
			if (controller.isNewPatient)
				;// TODO: read model and insert using $http
			else
				;// TODO: read model and update using $http
		};
	};
	
	/*
	 * Directive: patientBackgroundFormSection.
	 * Includes a section that allows to edit the patient background on the
	 * form.
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
	 * Directive: patientBasicDataFormSection.
	 * Includes a section that allows to edit the patient basic data on the
	 * form.
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
	 * Includes a patient form. If a patient model is specified, submiting the
	 * form will edit the corresponding patient; otherwise, a new patient will
	 * be added.
	 */
	function patientFormDirective() {
		var scope = {
			patient: '=',
			title: '@'
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
	 * Directive: patientMedicationsFormSection.
	 * Includes a section that allows to edit the patient medications on the
	 * form.
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
	 * Directive: patientSummaryFormSection.
	 * Includes a section to show a summary of the patient data entered on the
	 * form.
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
