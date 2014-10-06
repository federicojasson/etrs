(function() {
	var module = angular.module('etrs', ['patients']);
	
	module.controller('NonNegativeNumberInputController', function() {
		this.text = '';
		
		this.get = function() {
			return this.text;
		};
		
		this.set = function(value) {
			// TODO
			this.text = value;
		};
	});
	
	module.controller('YesNoInputController', function() {
		this.options = [
			{ label: 'Se desconoce', value: null },
			{ label: 'Sí', value: true },
			{ label: 'No', value: false }
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
	
	// TODO: organize
	
	/*module.directive('yesNoUnknownInput', function() {
		var scope = {
			model: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/yes-no-unknown-input.html'
		};
		
		return options;
	});
	
	module.directive('patientBackgroundSection', function() {
		var scope = {
			background: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-background-section.html'
		};
		
		return options;
	});
	
	module.directive('patientDataSection', function() {
		var scope = {
			data: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-data-section.html'
		};
		
		return options;
	});
	
	module.directive('patientMedicationsSection', function() {
		var scope = {
			medications: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/patient-medications-section.html'
		};
		
		return options;
	});
	
	
	
	
	
	module.controller('genderController', function() {
		
	});
	
	
	
	module.directive('newPatientForm', function() {
		var controller = function() {
			this.patient = {
				background: {
					dbt: null,
					dyslipidemia: null,
					ect: null,
					heartDisease: null,
					hiv: null,
					htn: null,
					psychiatricTreatment: null,
					relativesWithAlzheimer: null
				},
				data: {
					birthDate : null,
					gender: null,
					name: null,
					yearsOfEducation: null
				},
				medications: {
					antidepressants: null,
					antidiabetics: null,
					antihypertensives: null,
					antiplateletsAnticoagulants: null,
					antipsychotics: null,
					benzodiazepines: null,
					hypolipidemics: null,
					levothyroxine: null,
					melatonin: null
				}
			};
			
			this.isValidInput = function() {
				console.log('controller.isValidInput');
				console.log('Dato: ' + this.patient.data.gender);
				
				// TODO: validate input
				return false;
			};
			
			this.onSubmit = function() {
				console.log('controller.onSubmit');
				
				// TODO: send data
			};
		};
		
		var options = {
			controller: controller,
			controllerAs: 'controller',
			restrict: 'E',
			templateUrl: 'templates/new-patient-form.html'
		};
		
		return options;
	});*/
})();
