// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateLaboratoryTestFormController
	module.controller('CreateLaboratoryTestFormController', [
		'errorHandler',
		'Error',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		CreateLaboratoryTestFormController
	]);
	
	/*
	 * Controller: CreateLaboratoryTestFormController
	 * 
	 * Offers functions for the create laboratory test form.
	 */
	function CreateLaboratoryTestFormController(errorHandler, Error, inputValidator, InputModel, router, server) {
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
			
			// Creates the laboratory test
			server.createLaboratoryTest({
				name: inputModels.name.value,
				dataTypeDefinition: inputModels.dataTypeDefinition.value
			}).then(function() {
				// Redirects the user to the manage laboratory tests route
				router.redirect('/manage-laboratory-tests');
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		};
	}
})();
