// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: ChangePasswordFormController
	module.controller('ChangePasswordFormController', [
		'$route',
		'builder',
		'errorManager',
		'server',
		ChangePasswordFormController
	]);
	
	/*
	 * Controller: ChangePasswordFormController
	 * 
	 * Offers logic functions for the change password form.
	 */
	function ChangePasswordFormController($route, builder, errorManager, server) {
		var controller = this;
		
		/*
		 * Indicates whether the informative alert should be included.
		 */
		var includeInformativeAlert = false;
		
		/*
		 * The TODO input model.
		 */
		var TODOInputModel = builder.buildInputModel(function() {
			// TODO
			return true;
		});
		
		/*
		 * Validates the form input and returns the result.
		 */
		function validate() {
			// The form input is valid if all the input models are
			var isValid = true;
			
			// Gets the input models
			var inputModels = controller.inputModels;
			
			// Validates the input models
			for (var property in inputModels) {
				if (inputModels.hasOwnProperty(property)) {
					// Validates the input model and ANDs the result
					isValid &= inputModels[property].validate();
				}
			}
			
			return isValid;
		}
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			TODO: TODOInputModel
		};
		
		/*
		 * Closes the informative alert.
		 */
		controller.closeInformativeAlert = function() {
			includeInformativeAlert = false;
		};
		
		/*
		 * Determines whether the informative alert should be included.
		 */
		controller.includeInformativeAlert = function() {
			return includeInformativeAlert;
		};
		
		/*
		 * Submits the form.
		 * 
		 * If any of the input models is invalid, the appropriate actions are
		 * taken and the form is not submitted.
		 */
		controller.submit = function() {
			// Hides the informative alert
			includeInformativeAlert = false;
			
			if (! validate()) {
				// At least one input model is invalid
				return;
			}
			
			// Gets the input values
			var TODO = TODOInputModel.value;
			
			// Changes the user's password
			server.changePassword(TODO).then(function(response) {
				if (response.passwordChanged) {
					// The user's password was changed
					
					// Redirects the user to its view
					// TODO
					$route.reload();
				} else {
					// The user's password was not changed
					
					// Shows an informative alert
					includeInformativeAlert = true;
				}
			}, function(response) {
				// Error: the server responded with an HTTP error
				var error = builder.buildError(response);
				errorManager.reportError(error);
			});
		};
	}
})();
