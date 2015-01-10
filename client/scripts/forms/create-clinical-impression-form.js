// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateClinicalImpressionFormController
	module.controller('CreateClinicalImpressionFormController', [
		'errorHandler',
		'Error',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		CreateClinicalImpressionFormController
	]);
	
	/*
	 * Controller: CreateClinicalImpressionFormController
	 * 
	 * Offers functions for the create clinical impression form.
	 */
	function CreateClinicalImpressionFormController(errorHandler, Error, inputValidator, InputModel, router, server) {
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
			
			// Creates the clinical impression
			server.createClinicalImpression({
				name: inputModels.name.value
			}).then(function() {
				// Redirects the user to the manage clinical impressions route
				router.redirect('/manage-clinical-impressions');
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		};
	}
})();
