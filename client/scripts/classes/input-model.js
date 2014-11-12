// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('classes');
	
	// Factories
	module.factory('InputModel', InputModelFactory);
	
	/*
	 * Factory: InputModel.
	 * 
	 * It represents an input model.
	 */
	function InputModelFactory() {
		/*
		 * Creates an instance of this class.
		 */
		function InputModel(validate) {
			this.validate = validate;
		}
		
		/*
		 * Indicates whether the input is valid.
		 */
		InputModel.prototype.isInputValid = true;
		
		/*
		 * The message about the input model.
		 * 
		 * The message is usually used to show errors after validation.
		 */
		InputModel.prototype.message = '';
		
		/*
		 * The function used for validation.
		 * 
		 * This function must be defined by the caller and be passed through the
		 * constructor. It should set the inner state of the model and determine
		 * whether the input has passed the validation.
		 */
		InputModel.prototype.validate = null;
		
		/*
		 * The input model value.
		 * 
		 * This is the variable that should be bound with ng-model.
		 */
		InputModel.prototype.value = '';
		
		/*
		 * Returns the message about the input model.
		 */
		InputModel.prototype.getMessage = function() {
			return this.message;
		};
		
		/*
		 * Returns the input model value.
		 */
		InputModel.prototype.getValue = function() {
			return this.value;
		};
		
		/*
		 * Determines whether the input model is valid.
		 */
		InputModel.prototype.isValid = function() {
			return this.isInputValid;
		};
		
		return InputModel;
	}
})();
