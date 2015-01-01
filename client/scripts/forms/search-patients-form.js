// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: SearchPatientsFormController
	module.controller('SearchPatientsFormController', [
		'$timeout',
		'errorHandler',
		'Error',
		'searchPatientsForm',
		'InputModel',
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
	function SearchPatientsFormController($timeout, errorHandler, Error, searchPatientsForm, InputModel, server) {
		var controller = this;
		
		/*
		 * TODO
		 */
		var scheduledTask;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			query: new InputModel({
				initialValue: searchPatientsForm.getQuery()
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
		controller.submit = function() {
			var inputModels = controller.inputModels;
			
			// Searches the patients
			server.searchPatients({
				query: inputModels.query.value
			}).then(function(output) {
				// TODO: implement
				searchPatientsForm.setQuery(inputModels.query.value);
				searchPatientsForm.setSearchResults([
					'Paciente 1',
					'Paciente 2'
				]);
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
