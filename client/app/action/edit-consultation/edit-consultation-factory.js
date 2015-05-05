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
	angular.module('app.action.editConsultation').factory('EditConsultationAction', [
		'inputValidator',
		'Input',
		'server',
		EditConsultationActionFactory
	]);
	
	/**
	 * Defines the EditConsultationAction class.
	 */
	function EditConsultationActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		EditConsultationAction.prototype.input;
		
		/**
		 * The start callback.
		 */
		EditConsultationAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		EditConsultationAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function EditConsultationAction() {
			this.startCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				id: new Input(),
				version: new Input(),
				
				date: new Input(function() {
					return inputValidator.isDate(this);
				}),
				
				presentingProblem: new Input(function() {
					return inputValidator.isValidString(this, 0, 1024);
				}),
				
				comments: new Input(function() {
					return inputValidator.isValidString(this, 0, 1024);
				}),
				
				clinicalImpression: new Input(),
				diagnosis: new Input(),
				
				medicalAntecedents: new Input(function() {
					// TODO
				}),
				
				medicines: new Input(function() {
					// TODO
				}),
				
				laboratoryTestResults: new Input(function() {
					// TODO
				}),
				
				imagingTestResults: new Input(function() {
					// TODO
				}),
				
				cognitiveTestResults: new Input(function() {
					// TODO
				}),
				
				treatments: new Input(function() {
					// TODO
				})
			};
		}
		
		/**
		 * Executes the action.
		 */
		EditConsultationAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Edits the consultation
			server.consultation.edit({
				id: this.input.id.value,
				version: this.input.version.value,
				date: this.input.date.value,
				presentingProblem: this.input.presentingProblem.value,
				comments: this.input.comments.value,
				clinicalImpression: this.input.clinicalImpression.value,
				diagnosis: this.input.diagnosis.value,
				medicalAntecedents: this.input.medicalAntecedents.value,
				medicines: this.input.medicines.value,
				laboratoryTestResults: this.input.diagnosis.value,
				imagingTestResults: this.input.diagnosis.value,
				cognitiveTestResults: this.input.diagnosis.value,
				treatments: this.input.treatments.value
			}).then(function() {
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return EditConsultationAction;
	}
})();
