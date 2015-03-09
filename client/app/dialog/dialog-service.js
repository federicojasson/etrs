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
		'Dialog',
		dialogService
	]);
	
	/**
	 * Manages the dialogs.
	 */
	function dialogService($modal, Dialog) {
		var _this = this;
		
		/**
		 * The current dialog.
		 */
		var dialog = null;
		
		/**
		 * Returns the current dialog.
		 */
		_this.get = function() {
			return dialog;
		};
		
		/**
		 * Opens an information dialog.
		 * 
		 * Receives a title, a message and, optionally, a callback to be invoked
		 * when the dialog is closed.
		 */
		_this.openInformation = function(title, message, callback) {
			// Initializes the callback if is undefined
			callback = (angular.isDefined(callback)) ? callback : function() {};
			
			// Initializes the dialog
			dialog = new Dialog(title, message);
			
			// Defines the parameters for the dialog
			var parameters = {
				backdrop: 'static',
				controller: 'DialogController',
				controllerAs: 'dialog',
				templateUrl: 'app/dialog/dialog.html'
			};
			
			// Opens the dialog
			$modal.open(parameters).result.then(callback, callback);
		};
	}
})();
