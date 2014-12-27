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
		dialogsService
	]);
	
	/*
	 * Service: dialogs
	 * 
	 * TODO: comments
	 */
	function dialogsService($modal) {
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
		 */
		service.showInformationDialog = function(parameters) {
			var title = parameters.title; // TODO: use somehow
			var message = parameters.message; // TODO: use somehow
			var onClose = parameters.onClose;
			
			// Opens the dialog
			var modal = $modal.open({
				backdrop: 'static',
				templateUrl: 'templates/dialogs/information-dialog.html'
			});
			
			// Sets the callback function
			modal.result.then(onClose, onClose);
		};
	}
})();
