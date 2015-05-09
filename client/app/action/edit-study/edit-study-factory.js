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
	angular.module('app.action.editStudy').factory('EditStudyAction', [
		'inputValidator',
		'Input',
		'server',
		EditStudyActionFactory
	]);
	
	/**
	 * Defines the EditStudyAction class.
	 */
	function EditStudyActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		EditStudyAction.prototype.input;
		
		/**
		 * The start callback.
		 */
		EditStudyAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		EditStudyAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function EditStudyAction() {
			this.startCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				id: new Input(),
				version: new Input(),
				
				comments: new Input(function() {
					return inputValidator.isValidString(this, 0, 1024);
				}),
				
				files: new Input()
			};
		}
		
		/**
		 * Executes the action.
		 */
		EditStudyAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Edits the study
			server.study.edit({
				id: this.input.id.value,
				version: this.input.version.value,
				comments: this.input.comments.value,
				files: this.input.files.value
			}).then(function() {
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return EditStudyAction;
	}
})();
