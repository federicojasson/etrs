// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: forms
	var module = angular.module('forms');
	
	// Controller: RequestPasswordRecoveryFormController
	module.controller('RequestPasswordRecoveryFormController', [
		'dialogs',
		'inputValidator',
		'InputModel',
		'router',
		'server',
		RequestPasswordRecoveryFormController
	]);
	
	/*
	 * Controller: RequestPasswordRecoveryFormController
	 * 
	 * Offers functions for the request password recovery form.
	 */
	function RequestPasswordRecoveryFormController(dialogs, inputValidator, InputModel, router, server) {
		var controller = this;
		
		/*
		 * Indicates whether the alert should be shown.
		 */
		var showAlert = false;
		
		/*
		 * The input models.
		 */
		controller.inputModels = {
			id: new InputModel({
				validationFunction: function() {
					return inputValidator.validateRequiredInput(this);
				}
			}),
			
			emailAddress: new InputModel({
				validationFunction: function() {
					return inputValidator.validateRequiredInput(this);
				}
			})
		};
		
		/*
		 * Invoked when the alert's close button is pressed.
		 */
		controller.onCloseAlert = function() {
			showAlert = false;
		};
		
		/*
		 * Determines whether the alert should be shown.
		 */
		controller.showAlert = function() {
			return showAlert;
		};
		
		/*
		 * Submits the form.
		 * 
		 * If the input is invalid, the form is not submitted.
		 */
		controller.submit = function() {
			var inputModels = controller.inputModels;
			
			// Hides the alert
			showAlert = false;
			
			if (! inputValidator.validateInputModels(inputModels)) {
				// The input is invalid
				return;
			}
			
			// Requests the password recovery
			server.requestPasswordRecovery({
				id: inputModels.id.value,
				emailAddress: inputModels.emailAddress.value
			}).then(function(output) {
				if (output.requestAccepted) {
					// The request was accepted
					
					// Shows an information dialog
					dialogs.showInformationDialog({
						title: 'Solicitud aceptada',
						message: 'Su solicitud de recuperación de contraseña ha sido aceptada. Se ha enviado un correo electrónico a su casilla. Para continuar con el proceso deberá seguir los pasos indicados en el mismo.', // TODO: too long
						onClose: function() {
							// Redirects the user to the root route
							router.redirect('/');
						}});
				} else {
					// The request was not accepted
					
					// Shows the alert
					showAlert = true;
				}
			}, function(response) {
				// TODO: handle error
			});
		};
	}
})();
