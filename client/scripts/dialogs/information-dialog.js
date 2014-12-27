// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: dialogs
	var module = angular.module('dialogs');
	
	// Controller: InformationDialogController
	module.controller('InformationDialogController', [
		'$modal',
		'informationDialog',
		InformationDialogController
	]);
	
	// Service: informationDialog
	module.service('informationDialog', informationDialogService);
	
	/*
	 * Controller: InformationDialogController
	 * 
	 * TODO: comments
	 */
	function InformationDialogController($modal, informationDialog) {
		var controller = this;
		
		/*
		 * TODO: comments
		 */
		controller.getMessage = function() {
			return informationDialog.getMessage();
		};
		
		/*
		 * TODO: comments
		 */
		controller.getTitle = function() {
			return informationDialog.getTitle();
		};
	}
	
	/*
	 * Service: informationDialog
	 * 
	 * TODO: comments
	 */
	function informationDialogService() {
		var service = this;
		
		/*
		 * TODO: comments
		 */
		var message;
		
		/*
		 * TODO: comments
		 */
		var title;
		
		/*
		 * TODO: comments
		 */
		service.getMessage = function() {
			return message;
		};
		
		/*
		 * TODO: comments
		 */
		service.getTitle = function() {
			return title;
		};
		
		/*
		 * TODO: comments
		 */
		service.setMessage = function(newMessage) {
			message = newMessage;
		};
		
		/*
		 * TODO: comments
		 */
		service.setTitle = function(newTitle) {
			title = newTitle;
		};
	}
})();
