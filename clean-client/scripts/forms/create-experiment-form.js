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
			commandLine: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validateCommandLine(this)
				}
			}),

			name: new InputModel({
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
			
			// Creates the experiment
			server.createExperiment({
				commandLine: inputModels.experiment.commandLine.value,
				name: inputModels.experiment.name.value
			}).then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
