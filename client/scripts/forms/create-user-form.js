// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: CreateUserFormController
	module.controller('CreateUserFormController', [
		'InputModel',
		'inputValidator',
		'server',
		CreateUserFormController
	]);
	
	/*
	 * Controller: CreateUserFormController
	 * 
	 * Implements the logic of the create user form.
	 */
	function CreateUserFormController(InputModel, inputValidator, server) {
		var controller = this;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			id: new InputModel({
				validationFunction: function() {
					return	inputValidator.validateRequiredInput(this) &&
							inputValidator.validateUserId(this)
				}
			}),
			
			mainData: {
				firstName: new InputModel({
					validationFunction: function() {
						return	inputValidator.validateRequiredInput(this) &&
								inputValidator.validateName(this)
					}
				}),

				gender: new InputModel(),

				lastName: new InputModel({
					validationFunction: function() {
						return	inputValidator.validateRequiredInput(this) &&
								inputValidator.validateName(this)
					}
				})	
			}
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
			
			// TODO: check if user exists
			
			// Creates the user
			server.createUser({
				// TODO
			}).then(function() {
				// TODO: what to do now
			}, function(response) {
				// TODO: error
			});
		};
	}
})();
