// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: dialogs
	var module = angular.module('dialogs');
	
	// Controller: InformationDialogController
	module.controller('InformationDialogController', [
		'informationDialog',
		InformationDialogController
	]);
	
	// Service: informationDialog
	module.service('informationDialog', [
		'$modal',
		informationDialogService
	]);
	
	/*
	 * Controller: InformationDialogController
	 * 
	 * Offers functions for the information dialog.
	 */
	function InformationDialogController(informationDialog) {
		var controller = this;
		
		/*
		 * Returns the information dialog's message.
		 */
		controller.getMessage = function() {
			return informationDialog.getMessage();
		};
		
		/*
		 * Returns the information dialog's title.
		 */
		controller.getTitle = function() {
			return informationDialog.getTitle();
		};
	}
	
	/*
	 * Service: informationDialog
	 * 
	 * Offers functions to handle the information dialog.
	 */
	function informationDialogService($modal) {
		var service = this;
		
		/*
		 * The information dialog's message.
		 */
		var message;
		
		/*
		 * The information dialog's title.
		 */
		var title;
		
		/*
		 * Returns the information dialog's message.
		 */
		service.getMessage = function() {
			return message;
		};
		
		/*
		 * Returns the information dialog's title.
		 */
		service.getTitle = function() {
			return title;
		};
		
		/*
		 * Shows the information dialog.
		 * 
		 * It receives an object containing the parameters: the title, the
		 * message to show and a callback function to be executed when the
		 * dialog is closed. This object should have the following structure:
		 * 
		 *	parameters: {
		 *		title: ...,
		 *		message: ...,
		 *		onClose: ...
		 *	}
		 *	
		 *	The message can be a string or an array containing the different
		 *	lines.
		 */
		service.show = function(parameters) {
			var onClose = parameters.onClose;
			
			// Sets the title and message
			title = parameters.title;
			message = parameters.message;
			
			if (! angular.isArray(message)) {
				// The message is not an array
				message = [ message ];
			}
			
			// Opens the dialog
			var modal = $modal.open({
				backdrop: 'static',
				controller: 'InformationDialogController',
				controllerAs: 'dialog',
				templateUrl: 'templates/dialogs/information-dialog.html'
			});
			
			// Sets the callback function
			modal.result.then(onClose, onClose);
		};
	}
})();
