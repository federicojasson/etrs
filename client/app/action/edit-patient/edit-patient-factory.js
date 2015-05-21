/**
 * NEU-CO - Neuro-Cognitivo
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
	angular.module('app.action.editPatient').factory('EditPatientAction', [
		'inputValidator',
		'Input',
		'server',
		EditPatientActionFactory
	]);
	
	/**
	 * Defines the EditPatientAction class.
	 */
	function EditPatientActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		EditPatientAction.prototype.input;
		
		/**
		 * The start callback.
		 */
		EditPatientAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		EditPatientAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function EditPatientAction() {
			this.startCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				id: new Input(),
				version: new Input(),
				
				firstName: new Input(function() {
					return inputValidator.isValidString(this, 1, 48);
				}),
				
				lastName: new Input(function() {
					return inputValidator.isValidString(this, 1, 48);
				}),
				
				gender: new Input(function() {
					return inputValidator.isGender(this);
				}),
				
				birthDate: new Input(function() {
					return inputValidator.isDate(this);
				}),
				
				yearsOfEducation: new Input(function() {
					return inputValidator.isValidInteger(this, 0, 100);
				})
			};
		}
		
		/**
		 * Executes the action.
		 */
		EditPatientAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Edits the patient
			server.patient.edit({
				id: this.input.id.value,
				version: this.input.version.value,
				firstName: this.input.firstName.value,
				lastName: this.input.lastName.value,
				gender: this.input.gender.value,
				birthDate: this.input.birthDate.value,
				yearsOfEducation: this.input.yearsOfEducation.value
			}).then(function() {
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return EditPatientAction;
	}
})();
