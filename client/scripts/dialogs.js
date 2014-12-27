// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: dialogs
	var module = angular.module('dialogs', [
		'ui.bootstrap'
	]);
	
	// Service: dialogs
	module.service('dialogs', [
		'$modal',
		'informationDialog',
		dialogsService
	]);
	
	/*
	 * Service: dialogs
	 * 
	 * TODO: comments
	 */
	function dialogsService($modal, informationDialog) {
		var service = this;
		
		/*
		 * Opens an information dialog.
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
		service.showInformationDialog = function(parameters) {
			var title = parameters.title;
			var message = parameters.message;
			var onClose = parameters.onClose;
			
			if (! angular.isArray(message)) {
				// The message is not an array
				message = [ message ];
			}
			
			// Sets the title and message
			informationDialog.setTitle(title);
			informationDialog.setMessage(message);
			
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
