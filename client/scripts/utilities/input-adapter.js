// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('utilities');
	
	// Factories
	module.factory('inputAdapter', inputAdapterFactory);
	
	/*
	 * Factory: inputAdapter.
	 * 
	 * Generates input adapters, allowing the caller to specify which filters to
	 * use.
	 */
	function inputAdapterFactory() {
		/*
		 * Generates a function to use as the input adapter.
		 * It receives the filters that must be applied.
		 */
		var generateAdapter = function(filters) {
			/*
			 * It registers filters to modify the model value when the input
			 * changes. It also takes care of updating the value shown in the
			 * input element.
			 */
			var adaptInput = function(scope, element, attributes, ngModel) {
				// Adds the filters as a model parsers
				for (var i = 0; i < filters.length; i++) {
					ngModel.$parsers.push(filters[i]);
				}
				
				// Registers a function to execute when the element is defocused
				element.on('blur', function() {
					// Updates the element with the value of the model
					element.val(ngModel.$modelValue);
				});
			};
			
			// Returns the adaptation function
			return adaptInput;
		};
		
		// Returns the generation function
		return generateAdapter;
	};
})();
