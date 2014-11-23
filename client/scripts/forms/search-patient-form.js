// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: SearchPatientFormController
	module.controller('SearchPatientFormController', [
		'$location',
		'$scope',
		'$timeout',
		'base64ToHexadecimalFilter',
		'builder',
		'server',
		SearchPatientFormController
	]);
	
	/*
	 * Controller: SearchPatientFormController
	 * 
	 * Offers logic functions for the search patient form.
	 */
	function SearchPatientFormController($location, $scope, $timeout, base64ToHexadecimalFilter, builder, server) {
		var controller = this;
		
		/*
		 * The patients found.
		 */
		var patients = null;
		
		/*
		 * The search string input model.
		 */
		var searchStringInputModel = builder.buildInputModel(function() {
			// TODO: validate
			return true;
		});
		
		/*
		 * TODO
		 */
		var timer;
		
		/*
		 * Submits the form.
		 */
		function submit() {
			server.searchPatients().then(function(response) {
				patients = response.results;
			});
		}
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			searchString: searchStringInputModel
		};
		
		/*
		 * Returns the patients found.
		 */
		controller.getPatients = function() {
			return patients;
		};
		
		/*
		 * Redirects the user to a patient route.
		 * 
		 * It receives the patient's ID.
		 */
		controller.goToPatientRoute = function(id) {
			// Converts the ID to hexadecimal
			var hexadecimalId = base64ToHexadecimalFilter(id);
			
			// Redirects the user to the patient route
			$location.path('/patient/' + hexadecimalId);
		};
		
		/*
		 * Determines whether the no-results-found area should be included.
		 */
		controller.includeNoResultsFoundArea = function() {
			return patients.length === 0;
		};
		
		/*
		 * Determines whether the patients area should be included.
		 */
		controller.includePatientsArea = function() {
			return patients.length > 0;
		};
		
		/*
		 * Determines whether the results area should be included.
		 */
		controller.includeResultsArea = function() {
			return patients !== null;
		};
		
		/*
		 * Schedules the submission of the form.
		 */
		controller.scheduleSubmit = function() {
			// Cancels the timer's scheduled action
			$timeout.cancel(timer);
			
			// Schedules the submission of the form
			timer = $timeout(function() {
				submit();
			}, 750);
		};
		
		// Listens for the destroy event
		$scope.$on('$destroy', function() {
			// Cancels the timer's scheduled action
			$timeout.cancel(timer);
		});
	}
})();
