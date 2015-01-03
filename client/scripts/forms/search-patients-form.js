// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: SearchPatientsFormController
	module.controller('SearchPatientsFormController', [
		'$q',
		'$timeout',
		'data',
		'errorHandler',
		'Error',
		'searchPatientsForm',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		SearchPatientsFormController
	]);
	
	// Service: searchPatientsForm
	module.service('searchPatientsForm', searchPatientsFormService);
	
	/*
	 * Controller: SearchPatientsFormController
	 * 
	 * Offers functions for the search patients form.
	 */
	function SearchPatientsFormController($q, $timeout, data, errorHandler, Error, searchPatientsForm, inputValidator, InputModel, router, server) {
		var controller = this;
		
		/*
		 * TODO: comments
		 */
		var scheduledTask;
		
		/*
		 * TODO: comments
		 */
		var showSearchResults = searchPatientsForm.getQuery().length > 0;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			query: new InputModel({
				initialValue: searchPatientsForm.getQuery(),
				validationFunction: function() {
					return inputValidator.validateQuery(this);
				}
			})
		};
		
		/*
		 * TODO: comments
		 */
		controller.getSearchResults = function() {
			return searchPatientsForm.getSearchResults();
		};
		
		/*
		 * TODO: comments
		 */
		controller.goToPatientRoute = function(patientId) {
			router.redirect('/patient/' + patientId);
		};
		
		/*
		 * TODO: comments
		 */
		controller.scheduleSubmit = function() {
			// Cancels the scheduled task
			$timeout.cancel(scheduledTask);
			
			// Schedules the submission of the form
			scheduledTask = $timeout(function() {
				// Submits the form
				controller.submit();
			}, 750);
		};
		
		/*
		 * TODO: comments
		 */
		controller.showSearchResults = function() {
			return showSearchResults;
		};
		
		/*
		 * TODO: comments
		 */
		controller.submit = function() {
			var inputModels = controller.inputModels;
			var query = inputModels.query.value;
			
			// Hides the search results
			showSearchResults = false;
			
			if (! inputValidator.validateInputModels(inputModels)) {
				// The input is invalid
				return;
			}
			
			if (query.length === 0) {
				// There is no query
				
				// Resets the form's service
				searchPatientsForm.setQuery('');
				searchPatientsForm.setSearchResults([]);
				
				return;
			}
			
			// Searches the patients
			server.searchPatients({
				query: query
			}).then(function(output) {
				// Initializes an array for the deferred tasks' promises
				var promises = [];
				
				// Prepares the data service
				data.prepare([
					'patients'
				]);
				
				// Gets the patients
				for (var i = 0; i < output.length; i++) {
					promises.push(data.getPatient(output[i]));
				}
				
				return $q.all(promises);
			}).then(function(patients) {
				// Sets the query and the search results in the form's service
				searchPatientsForm.setQuery(query);
				searchPatientsForm.setSearchResults(patients);
				
				// Shows the search results
				showSearchResults = true;
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		};
	}
	
	/*
	 * Service: searchPatientsForm
	 * 
	 * TODO: comments
	 */
	function searchPatientsFormService() {
		var service = this;
		
		/*
		 * TODO: comments
		 */
		var query = '';
		
		/*
		 * TODO: comments
		 */
		var searchResults = [];
		
		/*
		 * TODO: comments
		 */
		service.getQuery = function() {
			return query;
		};
		
		/*
		 * TODO: comments
		 */
		service.getSearchResults = function() {
			return searchResults;
		};
		
		/*
		 * TODO: comments
		 */
		service.setQuery = function(newQuery) {
			query = newQuery;
		};
		
		/*
		 * TODO: comments
		 */
		service.setSearchResults = function(newSearchResults) {
			searchResults = newSearchResults;
		};
	}
})();
