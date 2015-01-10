// Uses strict mode in the whole script
'use strict';

// TODO: handle files upload

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateExperimentFormController
	module.controller('CreateExperimentFormController', [
		'errorHandler',
		'Error',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		CreateExperimentFormController
	]);
	
	/*
	 * Controller: CreateExperimentFormController
	 * 
	 * Offers functions for the create experiment form.
	 */
	function CreateExperimentFormController(errorHandler, Error, inputValidator, InputModel, router, server) {
		var controller = this;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			name: new InputModel({
				validationFunction: function() {
					// TODO: implement
					return true;
				}
			}),
			
			commandLine: new InputModel({
				validationFunction: function() {
					// TODO: implement
					return true;
				}
			})
		};
		
		/*
		 * Submits the form.
		 * 
		 * If the input is invalid, the form is not submitted.
		 */
		controller.submit = function() {
			var inputModels = controller.inputModels;
			
			if (! inputValidator.validateInputModels(inputModels)) {
				// The input is invalid
				return;
			}
			
			// Creates the experiment
			server.createExperiment({
				name: inputModels.name.value,
				commandLine: inputModels.commandLine.value
			}).then(function() {
				// Redirects the user to the manage experiments route
				router.redirect('/manage-experiments');
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		};
	}
})();
