(function() {
	var module = angular.module('etrs', []);
	
	// TODO: organize
	
	module.directive('patientBackgroundSection', function() {
		var scope = {
			controller: '='
		};
		
		var options = {
			restrict: 'E',
			templateUrl: 'templates/patient-background-section.html'
		};
		
		return options;
	});
	
	module.directive('radiosInput', function() {
		var scope = {
			model: '=',
			name: '@',
			values: '='
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/radios-input.html'
		};
		
		return options;
	});
	
	module.directive('yesNoUnknownSection', function() {
		var scope = {
			label: '@',
			model: '=',
			name: '@'
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'templates/yes-no-unknown-section.html'
		};
		
		return options;
	});
	
	module.directive('newPatientForm', function() {
		var controller = function() {
			this.data = {}; // TODO: necessary?
			this.model = {}; // TODO: debug
			
			this.isValidInput = function() {
				console.log('Dato: ' + this.model);
				
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
	});
	
	/*module.directive("dateSection", function() {
		return {
			restrict: 'E',
			scope: {
				label: '@'
			},
			templateUrl: 'templates/date-section.html'
		};
	});
	
	module.directive("genderSelect", function() {
		return {
			restrict: 'E',
			scope: {
				name: '@'
			},
			templateUrl: 'templates/gender-select.html'
		};
	});
	
	module.directive("numberTextfield", function() {
		return {
			restrict: 'E',
			scope: {
				label: '@',
				name: '@',
				placeholder: '@'
			},
			templateUrl: 'templates/number-textfield.html'
		};
	});
	
	module.directive("yesNoUnknownRadios", function() {
		return {
			restrict: 'E',
			scope: {
				label: '@',
				name: '@'
			},
			templateUrl: 'templates/yes-no-unknown-radios.html'
		};
	});
	
	module.directive("patientBackgroundSection", function() {
		return {
			restrict: 'E',
			templateUrl: 'templates/patient-background-section.html'
		};
	});
	
	module.directive("patientDataSection", function() {
		return {
			restrict: 'E',
			templateUrl: 'templates/patient-data-section.html'
		};
	});
	
	module.directive("patientMedicationsSection", function() {
		return {
			restrict: 'E',
			templateUrl: 'templates/patient-medications-section.html'
		};
	});
	
	module.directive("newPatientForm", function() {
		return {
			restrict: 'E',
			templateUrl: 'templates/new-patient-form.html'
		};
	});*/
})();
