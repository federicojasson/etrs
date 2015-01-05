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
		var showResults = searchPatientsForm.getQuery().length > 0;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			query: new InputModel({
				initialValue: searchPatientsForm.getQuery(),
				validationFunction: function() {
					return inputValidator.validateQuery(this);
				}
			}),
			
			page: new InputModel({
				initialValue: searchPatientsForm.getPage()
			})
		};
		
		/*
		 * TODO: comments
		 */
		controller.getResults = function() {
			return searchPatientsForm.getResults();
		};
		
		/*
		 * TODO: comments
		 */
		controller.getTotalResults = function() {
			return searchPatientsForm.getTotalResults();
		};
		
		/*
		 * TODO: comments
		 */
		controller.onPatientClick = function(patientId) {
			router.redirect('/patient/' + patientId);
		};
		
		/*
		 * TODO: comments
		 */
		controller.onQueryChange = function() {
			// Hides the results
			showResults = false;
			
			// Cancels the scheduled task (if there is any)
			$timeout.cancel(scheduledTask);
			
			// Resets the page
			controller.inputModels.page.value = 1;
			
			// Schedules a new task
			scheduledTask = $timeout(function() {
				// Submits the form
				controller.submit();
			}, 750);
		};
		
		/*
		 * TODO: comments
		 */
		controller.showResults = function() {
			return showResults;
		};
		
		/*
		 * TODO: comments
		 */
		controller.submit = function() {
			var inputModels = controller.inputModels;
			var query = inputModels.query.value;
			var page = inputModels.page.value;
			
			// Hides the results
			showResults = false;
			
			// Cancels the scheduled task (if there is any)
			$timeout.cancel(scheduledTask);
			
			if (! inputValidator.validateInputModels(inputModels)) {
				// The input is invalid
				return;
			}
			
			if (query.length === 0) {
				// There is no query
				
				// Resets the form's service
				searchPatientsForm.setQuery('');
				searchPatientsForm.setPage(1);
				searchPatientsForm.setTotalResults(0);
				searchPatientsForm.setResults([]);
				
				return;
			}
			
			// Searches the patients
			server.searchPatients({
				query: query,
				page: page
			}).then(function(output) {
				var totalResults = output.totalResults; // TODO: check
				var results = output.results;
				
				// Initializes an array for the deferred tasks' promises
				var promises = [];
				
				// Prepares the data service
				data.prepare([
					'patients'
				]);
				
				// Gets the patients
				for (var i = 0; i < results.length; i++) {
					promises.push(data.getPatient(results[i]));
				}
				
				return $q.all(promises);
			}).then(function(patients) {
				// Updates the form's service
				searchPatientsForm.setQuery(query);
				searchPatientsForm.setPage(page);
				searchPatientsForm.setTotalResults(totalResults);
				searchPatientsForm.setResults(patients);
				
				// Shows the results
				showResults = true;
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
		var page = 1;
		
		/*
		 * TODO: comments
		 */
		var query = '';
		
		/*
		 * TODO: comments
		 */
		var results = [];
		
		/*
		 * TODO: comments
		 */
		var totalResults = 0;
		
		/*
		 * TODO: comments
		 */
		service.getPage = function() {
			return page;
		};
		
		/*
		 * TODO: comments
		 */
		service.getQuery = function() {
			return query;
		};
		
		/*
		 * TODO: comments
		 */
		service.getResults = function() {
			return results;
		};
		
		/*
		 * TODO: comments
		 */
		service.getTotalResults = function() {
			return totalResults;
		};
		
		/*
		 * TODO: comments
		 */
		service.setPage = function(newPage) {
			page = newPage;
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
		service.setResults = function(newResults) {
			results = newResults;
		};
		
		/*
		 * TODO: comments
		 */
		service.setTotalResults = function(newTotalResults) {
			totalResults = newTotalResults;
		};
	}
})();
