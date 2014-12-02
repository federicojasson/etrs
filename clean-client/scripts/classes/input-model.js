// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: classes
	var module = angular.module('classes');
	
	// Factory: InputModel
	module.factory('InputModel', InputModelFactory);
	
	/*
	 * Factory: InputModel
	 * 
	 * It represents an input model.
	 */
	function InputModelFactory() {
		/*
		 * Creates an instance of this class.
		 * 
		 * It optionally receives an object containing parameters: the
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
				// Extracts the parameters
				
				if (angular.isDefined(parameters.initialValue)) {
					this.value = parameters.initialValue;
				}
				
				if (angular.isDefined(parameters.validationFunction)) {
					this.validationFunction = parameters.validationFunction;
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
		InputModel.prototype.validate = function() {
			// Validates the input and sets the result
			this.isValid = this.validationFunction();
			
			// Returns the result
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
