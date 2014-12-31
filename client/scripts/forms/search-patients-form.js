// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: SearchPatientsFormController
	module.controller('SearchPatientsFormController', [
		'$timeout',
		'searchPatientsForm',
		SearchPatientsFormController
	]);
	
	// Service: searchPatientsForm
	module.service('searchPatientsForm', searchPatientsFormService);
	
	/*
	 * Controller: SearchPatientsFormController
	 * 
	 * Offers functions for the search patients form.
	 */
	function SearchPatientsFormController($timeout, searchPatientsForm) {
		var controller = this;
		
		/*
		 * TODO
		 */
		var scheduledTask;
		
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
			// Cancels the timer's scheduled task
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
			// TODO: implement
			
			searchPatientsForm.setSearchResults([
				'Paciente 1',
				'Paciente 2'
			]);
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
		var searchResults = [];
		
		/*
		 * TODO: comments
		 */
		service.getSearchResults = function() {
			return searchResults;
		};
		
		/*
		 * TODO: comments
		 */
		service.setSearchResults = function(newSearchResults) {
			searchResults = newSearchResults;
		};
	}
})();
