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
			experimentCommandLine: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validateCommandLine(this)
				}
			}),
			
			experimentName: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validateName(this)
				}
			})
		};
		
		/*
		 * Submits the form.
		 * 
		 * If the input is invalid, the form is not submitted.
		 */
		controller.submit = function() {
			// Gets the input models
			var inputModels = controller.inputModels;
			
			if (! inputValidator.validate(inputModels)) {
				// The input is invalid
				return;
			}
			
			// Gets the input
			var experimentCommandLine = inputModels.experimentCommandLine.value;
			var experimentName = inputModels.experimentName.value;
			
			// Creates the experiment
			server.createExperiment().then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
