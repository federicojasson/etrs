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
	angular.module('app.action.createMedicine').factory('CreateMedicineAction', [
		'inputValidator',
		'InputModel',
		'server',
		CreateMedicineActionFactory
	]);
	
	/**
	 * Defines the CreateMedicineAction class.
	 */
	function CreateMedicineActionFactory(inputValidator, InputModel, server) {
		/**
		 * The input.
		 */
		CreateMedicineAction.prototype.input;
		
		/**
		 * The start callback.
		 * 
		 * It is invoked at the start of the action.
		 */
		CreateMedicineAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 * 
		 * It is invoked when the action is successful.
		 */
		CreateMedicineAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function CreateMedicineAction() {
			// Initializes the callbacks
			this.startCallback = function() {};
			this.successCallback = function() {};
			
			// Defines the input
			this.input = {
				name: new InputModel(function() {
					return inputValidator.isValidText(this, 1, 64);
				})
			};
		}
		
		/**
		 * Executes the action.
		 */
		CreateMedicineAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Defines the input to be sent to the server
			var input = {
				name: this.input.name.value
			};
			
			// Creates the medication
			server.medicine.create(input).then(function(output) {
				// Invokes the success callback
				this.successCallback(output.id);
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return CreateMedicineAction;
	}
})();
