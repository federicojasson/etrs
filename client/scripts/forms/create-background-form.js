// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateBackgroundFormController
	module.controller('CreateBackgroundFormController', [
		'errorHandler',
		'Error',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		CreateBackgroundFormController
	]);
	
	/*
	 * Controller: CreateBackgroundFormController
	 * 
	 * Offers functions for the create background form.
	 */
	function CreateBackgroundFormController(errorHandler, Error, inputValidator, InputModel, router, server) {
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
			
			// Creates the background
			server.createBackground({
				name: inputModels.name.value
			}).then(function() {
				// Redirects the user to the manage backgrounds route
				router.redirect('/manage-backgrounds');
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		};
	}
})();
