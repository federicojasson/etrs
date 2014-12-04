// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateExperimentFormController
	module.controller('CreateExperimentFormController', [
		'InputModel',
		'inputValidator',
		'server',
		CreateExperimentFormController
	]);
	
	/*
	 * Controller: CreateExperimentFormController
	 * 
	 * Implements the logic of the create experiment form.
	 */
	function CreateExperimentFormController(InputModel, inputValidator, server) {
		var controller = this;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			// TODO
		};
		
		/*
		 * Submits the form.
		 * 
		 * If the input is invalid, the form is not submitted.
		 */
		controller.submit = function() {
			if (! inputValidator.validate(controller.inputModels)) {
				// The input is invalid
				return;
			}
			
			// Gets the input
			// TODO
			
			// Creates the experiment
			server.createExperiment().then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
