// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: inputValidator
	var module = angular.module('inputValidator');
	
	// Factory: InputModel
	module.factory('InputModel', InputModelFactory);
	
	/*
	 * Factory: InputModel
	 * 
	 * Implements a class that represents an input model.
	 */
	function InputModelFactory() {
		/*
		 * Creates an instance of this class.
		 * 
		 * It optionally receives an object containing the parameters: the
		 * validation function and the initial value. This object should have
		 * the following structure:
		 * 
		 *	parameters: {
		 *		initialValue: ...,
		 *		validationFunction: ...
		 *	}
		 * 
		 * Both properties are optional.
		 */
		function InputModel(parameters) {
			if (angular.isDefined(parameters)) {
				var initialValue = parameters.initialValue;
				var validationFunction = parameters.validationFunction;
				
				if (angular.isDefined(initialValue)) {
					// Initial value received
					this.value = initialValue;
				}
				
				if (angular.isDefined(validationFunction)) {
					// Validation function received
					this.validationFunction = validationFunction;
				}
			}
		}
		
		/*
		 * Indicates whether the input is valid.
		 */
		InputModel.prototype.isValid = true;
		
		/*
		 * A message about the input.
		 * 
		 * This can be used to inform errors after the validation.
		 */
		InputModel.prototype.message = '';
		
		/*
		 * The input value.
		 * 
		 * This is the variable that should be bound with ng-model.
		 */
		InputModel.prototype.value = '';
		
		/*
		 * Validates the input, changes the object state to reflect it and
		 * returns the result.
		 */
		InputModel.prototype.validateInput = function() {
			// Validates the input and sets the result
			this.isValid = this.validationFunction();
			
			return this.isValid;
		};
		
		/*
		 * Validates the input and returns the result.
		 * 
		 * This function can be redefined by the caller using the constructor.
		 */
		InputModel.prototype.validationFunction = function() {
			return true;
		};
		
		return InputModel;
	}
})();
