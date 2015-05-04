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
	angular.module('app.action.createStudy').factory('CreateStudyAction', [
		'inputValidator',
		'Input',
		'server',
		CreateStudyActionFactory
	]);
	
	/**
	 * Defines the CreateStudyAction class.
	 */
	function CreateStudyActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		CreateStudyAction.prototype.input;
		
		/**
		 * The start callback.
		 */
		CreateStudyAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		CreateStudyAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function CreateStudyAction() {
			this.startCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				comments: new Input(function() {
					return inputValidator.isValidString(this, 0, 1024);
				}),
				
				consultation: new Input(),
				
				experiment: new Input(function() {
					return inputValidator.isExperiment(this);
				}),
				
				input: new Input(function() {
					return inputValidator.isFile(this);
				}),
				
				files: new Input()
			};
		}
		
		/**
		 * Executes the action.
		 */
		CreateStudyAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Creates the study
			server.study.create({
				comments: this.input.comments.value,
				consultation: this.input.consultation.value,
				experiment: this.input.experiment.value,
				input: this.input.input.value,
				files: this.input.files.value
			}).then(function(output) {
				// Invokes the success callback
				this.successCallback(output.id);
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return CreateStudyAction;
	}
})();
