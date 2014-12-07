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
		'errorManager',
		'server',
		SearchPatientFormController
	]);
	
	/*
	 * Controller: SearchPatientFormController
	 * 
	 * Offers logic functions for the search patient form.
	 */
	function SearchPatientFormController($location, $scope, $timeout, base64ToHexadecimalFilter, builder, errorManager, server) {
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
			if (! validate()) {
				// At least one input model is invalid
				return;
			}
			
			// Gets the input values
			var searchString = searchStringInputModel.value;
			
			// Searches the patients
			server.searchPatients(searchString).then(function(response) {
				// TODO: nothing more?
				patients = response.results;
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = builder.buildError(response);
				errorManager.reportError(error);
			});
		}
		
		/*
		 * Validates the form input and returns the result.
		 */
		function validate() {
			// TODO: metodo repetido en todos los forms: agregar validador
			
			// The form input is valid if all the input models are
			var isValid = true;
			
			// Gets the input models
			var inputModels = controller.inputModels;
			
			// Validates the input models
			for (var property in inputModels) {
				if (inputModels.hasOwnProperty(property)) {
					// Validates the input model and ANDs the result
					isValid &= inputModels[property].validate();
				}
			}
			
			return isValid;
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
