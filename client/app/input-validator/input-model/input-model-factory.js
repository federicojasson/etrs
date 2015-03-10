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
	angular.module('app.inputValidator.inputModel').factory('InputModel', InputModelFactory);
	
	/**
	 * Defines the InputModel class.
	 */
	function InputModelFactory() {
		/**
		 * The message about the input.
		 * 
		 * It can be used to provide useful information in case the validation
		 * fails.
		 */
		InputModel.prototype.message;
		
		/**
		 * Indicates whether the input is valid.
		 */
		InputModel.prototype.valid;
		
		/**
		 * The validator.
		 * 
		 * Besides determining whether the input is valid, it should set the
		 * appropriate message to describe why the validation failed.
		 */
		InputModel.prototype.validator;
		
		/**
		 * The value.
		 */
		InputModel.prototype.value;
		
		/**
		 * Initializes an instance of the class.
		 * 
		 * Receives the validator.
		 */
		function InputModel(validator) {
			// Sets the validator
			this.validator = validator;
			
			// Sets default values
			this.message = '';
			this.valid = true;
			this.value = '';
		}
		
		/**
		 * Validates the input.
		 */
		InputModel.prototype.validate = function() {
			this.valid = this.validator();
		};
		
		// ---------------------------------------------------------------------
		
		return InputModel;
	}
})();
