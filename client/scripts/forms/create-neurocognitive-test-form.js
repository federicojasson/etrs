// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateNeurocognitiveTestFormController
	module.controller('CreateNeurocognitiveTestFormController', [
		'errorHandler',
		'Error',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		CreateNeurocognitiveTestFormController
	]);
	
	/*
	 * Controller: CreateNeurocognitiveTestFormController
	 * 
	 * Offers functions for the create neurocognitive test form.
	 */
	function CreateNeurocognitiveTestFormController(errorHandler, Error, inputValidator, InputModel, router, server) {
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
			
			// Creates the neurocognitive test
			server.createNeurocognitiveTest({
				name: inputModels.name.value,
				dataTypeDefinition: inputModels.dataTypeDefinition.value
			}).then(function() {
				// Redirects the user to the manage neurocognitive tests route
				router.redirect('/manage-neurocognitive-tests');
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		};
	}
})();
