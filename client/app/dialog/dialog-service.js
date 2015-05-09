/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.dialog').service('dialog', [
		'$modal',
		dialogService
	]);
	
	/**
	 * Manages the dialogs.
	 */
	function dialogService($modal) {
		var _this = this;
		
		/**
		 * The open dialog.
		 */
		var dialog = null;
		
		/**
		 * Returns the open dialog.
		 */
		_this.get = function() {
			return dialog;
		};
		
		/**
		 * Opens a confirmation dialog.
		 * 
		 * Receives the title, the message and, optionally, a callback to be
		 * invoked when the dialog is closed and another one to be invoked when
		 * it is dismissed.
		 */
		_this.openConfirmation = function(title, message, closedCallback, dismissedCallback) {
			open('confirmation', title, message, closedCallback, dismissedCallback);
		};
		
		/**
		 * Opens an error dialog.
		 * 
		 * Receives the title, the message and, optionally, a callback to be
		 * invoked when the dialog is closed or dismissed.
		 */
		_this.openError = function(title, message, callback) {
			open('error', title, message, callback, callback);
		};
		
		/**
		 * Opens an information dialog.
		 * 
		 * Receives the title, the message and, optionally, a callback to be
		 * invoked when the dialog is closed or dismissed.
		 */
		_this.openInformation = function(title, message, callback) {
			open('information', title, message, callback, callback);
		};
		
		/**
		 * Returns the settings.
		 */
		function getSettings() {
			return {
				backdrop: 'static',
				controller: 'DialogController',
				controllerAs: 'dialog',
				templateUrl: 'app/dialog/dialog.html'
			};
		}
		
		/**
		 * Opens a dialog.
		 * 
		 * Receives the type, the title, the message and, optionally, a callback
		 * to be invoked when the dialog is closed and another one to be invoked
		 * when it is dismissed.
		 */
		function open(type, title, message, closedCallback, dismissedCallback) {
			// Initializes the dialog
			dialog = {
				type: type,
				title: title,
				message: message
			};
			
			// Gets the settings
			var settings = getSettings();
			
			// Opens the dialog
			$modal.open(settings).result.then(closedCallback, dismissedCallback);
		}
	}
})();
