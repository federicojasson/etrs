(function() {
	var module = angular.module('etrs', []);
	
	module.directive("dateSection", function() {
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
	});
})();
