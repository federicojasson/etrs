// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateNeurocognitiveEvaluationFormController
	module.controller('CreateNeurocognitiveEvaluationFormController', [
		'errorHandler',
		'Error',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		CreateNeurocognitiveEvaluationFormController
	]);
	
	/*
	 * Controller: CreateNeurocognitiveEvaluationFormController
	 * 
	 * Offers functions for the create neurocognitive evaluation form.
	 */
	function CreateNeurocognitiveEvaluationFormController(errorHandler, Error, inputValidator, InputModel, router, server) {
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
			
			dataTypeDefinition: new InputModel({
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
			
			// Creates the neurocognitive evaluation
			server.createNeurocognitiveEvaluation({
				name: inputModels.name.value,
				dataTypeDefinition: inputModels.dataTypeDefinition.value
			}).then(function() {
				// Redirects the user to the manage neurocognitive evaluations
				// route
				router.redirect('/manage-neurocognitive-evaluations');
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		};
	}
})();
