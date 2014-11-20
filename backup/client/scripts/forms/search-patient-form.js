// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('forms');
	
	// Controllers
	module.controller('SearchPatientFormController', SearchPatientFormController);
	
	// Directives
	module.directive('searchPatientForm', searchPatientFormDirective);
	
	/*
	 * Controller: SearchPatientFormController.
	 * 
	 * Offers logic functions for the search patient form.
	 */
	function SearchPatientFormController() {
		var controller = this;
		
		/*
		 * Submits the form.
		 */
		controller.submit = function() {
			// TODO
		};
	}
	
	/*
	 * Directive: searchPatientForm.
	 * 
	 * Includes the search patient form.
	 */
	function searchPatientFormDirective() {
		var options = {
			controller: 'SearchPatientFormController',
			controllerAs: 'form',
			restrict: 'A',
			scope: {},
			templateUrl: 'templates/forms/search-patient-form.html'
		};
		
		return options;
	}
})();
