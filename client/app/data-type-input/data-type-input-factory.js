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
	angular.module('app.dataTypeInput').factory('DataTypeInput', [
		'utility',
		DataTypeInput
	]);
	
	/**
	 * Defines the DataTypeInput class.
	 */
	function DataTypeInput(utility) {
		/**
		 * The boolean data type.
		 */
		DataTypeInput.BOOLEAN = 'boolean';
		
		/**
		 * The integer_fix_values data type.
		 */
		DataTypeInput.INTEGER_FIX_VALUES = 'integer_fix_values';
		
		/**
		 * The integer_range data type.
		 */
		DataTypeInput.INTEGER_RANGE = 'integer_range';
		
		/**
		 * The data type.
		 */
		DataTypeInput.prototype.dataType;
		
		/**
		 * The definition.
		 */
		DataTypeInput.prototype.definition;
		
		/**
		 * The validator.
		 */
		DataTypeInput.prototype.validator;
		
		/**
		 * Initializes an instance of the class.
		 * 
		 * Receives the data type, the definition and the validator.
		 */
		function DataTypeInput(dataType, definition, validator) {
			this.dataType = dataType;
			this.definition = definition;
			this.validator = validator;
		}

		/**
		 * Creates a data-type input.
		 * 
		 * Receives a formatted definition.
		 */
		DataTypeInput.create = function(formattedDefinition) {
			// Gets the fields
			var fields = DataTypeInput.getFields(formattedDefinition);
			
			// Gets the data type
			var dataType = DataTypeInput.getDataType(fields);
			
			// Gets the definition
			var definition = DataTypeInput.getDefinition(fields);
			
			// Creates the validator
			var validator = DataTypeInput.createValidator(dataType, definition);
			
			// Initializes the data-type input
			return new DataTypeInput(dataType, definition, validator);
		};

		/**
		 * Creates a boolean validator.
		 * 
		 * Receives the definition.
		 */
		DataTypeInput.createBooleanValidator = function(definition) {
			return function(input) {
				if (input.value === '') {
					// The option has not been selected
					input.message = 'Seleccione una opción';
					return false;
				}
				
				return true;
			};
		};

		/**
		 * Creates an integer_fix_values validator.
		 * 
		 * Receives the definition.
		 */
		DataTypeInput.createIntegerFixValuesValidator = function(definition) {
			return function(input) {
				if (input.value === '') {
					// The option has not been selected
					input.message = 'Seleccione una opción';
					return false;
				}
				
				return true;
			};
		};

		/**
		 * Creates an integer_range validator.
		 * 
		 * Receives the definition.
		 */
		DataTypeInput.createIntegerRangeValidator = function(definition) {
			return function(input) {
				if (input.value < definition.min) {
					// The input is too low
					input.message = 'El valor de este campo debe ser mayor o igual que ' + definition.min;
					return false;
				}
				
				if (input.value > definition.max) {
					// The input is too high
					input.message = 'El valor de este campo debe ser menor o igual que ' + definition.max;
					return false;
				}
				
				return true;
			};
		};
		
		/**
		 * Creates a validator.
		 * 
		 * Receives the data type and the definition.
		 */
		DataTypeInput.createValidator = function(dataType, definition) {
			// Creates the validator according to the data type
			switch (dataType) {
				case DataTypeInput.BOOLEAN: {
					return DataTypeInput.createBooleanValidator(definition);
				}

				case DataTypeInput.INTEGER_FIX_VALUES: {
					return DataTypeInput.createIntegerFixValuesValidator(definition);
				}

				case DataTypeInput.INTEGER_RANGE: {
					return DataTypeInput.createIntegerRangeValidator(definition);
				}
			}
		};

		/**
		 * Returns the data type from a set of fields.
		 * 
		 * Receives the fields.
		 */
		DataTypeInput.getDataType = function(fields) {
			// Gets the data type
			var dataType = fields[0];

			// Builds an array containing the data types
			var dataTypes = [
				DataTypeInput.BOOLEAN,
				DataTypeInput.INTEGER_FIX_VALUES,
				DataTypeInput.INTEGER_RANGE
			];

			if (! utility.inArray(dataType, dataTypes)) {
				// The data type is invalid
				throw new Error();
			}

			return dataType;
		};

		/**
		 * Returns the definition from a set of fields.
		 * 
		 * Receives the fields.
		 */
		DataTypeInput.getDefinition = function(fields) {
			var definition = {};

			// Adds all fields, except the first one, to the definition
			for (var i = 1; i < fields.length; i++) {
				var field = fields[i];

				// Gets the subfields
				var subfields = DataTypeInput.getSubfields(field);
				
				// Gets the label and the value
				var label = subfields[0];
				var value = subfields[1];

				if (definition.hasOwnProperty(label)) {
					// There is a duplicate label
					throw new Error();
				}

				// Adds the field to the definition
				definition[label] = value;
			}

			// Gets the data type
			var dataType = fields[0];
			
			// Processes the definition according to the data type
			switch (dataType) {
				case DataTypeInput.BOOLEAN: {
					return DataTypeInput.processBooleanDefinition(definition);
				}

				case DataTypeInput.INTEGER_FIX_VALUES: {
					return DataTypeInput.processIntegerFixValuesDefinition(definition);
				}

				case DataTypeInput.INTEGER_RANGE: {
					return DataTypeInput.processIntegerRangeDefinition(definition);
				}
			}
		};

		/**
		 * Returns the fields from a formatted definition.
		 * 
		 * Receives the formatted definition.
		 */
		DataTypeInput.getFields = function(formattedDefinition) {
			// Gets the fields
			var fields = formattedDefinition.split(';');

			// Trims and shrinks the fields
			return utility.filterArray(fields, utility.trimAndShrink);
		};

		/**
		 * Returns the subfields of a field.
		 * 
		 * Receives the field.
		 */
		DataTypeInput.getSubfields = function(field) {
			// Gets the subfields
			var subfields = field.split(':');

			if (subfields.length !== 2) {
				// The field format is invalid
				throw new Error();
			}

			// Trims and shrinks the subfields
			subfields = utility.filterArray(subfields, utility.trimAndShrink);

			// Gets the label
			var label = subfields[0];

			if (label === '') {
				// The label is not specified
				throw new Error();
			}

			// Gets the value
			var value = subfields[1];

			if (value === '') {
				// The value is not specified
				throw new Error();
			}

			return subfields;
		};

		/**
		 * Processes a definition of the boolean data type.
		 * 
		 * Receives the definition.
		 */
		DataTypeInput.processBooleanDefinition = function(definition) {
			if (utility.getObjectLength(definition) > 2) {
				// There are too many fields defined
				throw new Error();
			}

			if (! utility.inObject('false', definition)) {
				// The "false" value is not defined
				throw new Error();
			}

			if (! utility.inObject('true', definition)) {
				// The "true" value is not defined
				throw new Error();
			}

			// Converts the values from string to boolean
			return utility.filterObject(definition, utility.stringToBoolean);
		};

		/**
		 * Processes a definition of the integer_fix_values data type.
		 * 
		 * Receives the definition.
		 */
		DataTypeInput.processIntegerFixValuesDefinition = function(definition) {
			if (utility.getObjectLength(definition) === 0) {
				// There are no fields defined
				throw new Error();
			}

			// Checks if the values represent integers
			for (var label in definition) {
				if (! definition.hasOwnProperty(label)) {
					continue;
				}
				
				if (! utility.isStringAnInteger(definition[label])) {
					// The value doesn't represent an integer
					throw new Error();
				}
			}

			if (utility.objectContainsDuplicates(definition)) {
				// There is a duplicate value
				throw new Error();
			}

			// Converts the values to integer
			return utility.filterObject(definition, utility.stringToInteger);
		};

		/**
		 * Processes a definition of the integer_range data type.
		 * 
		 * Receives the definition.
		 */
		DataTypeInput.processIntegerRangeDefinition = function(definition) {
			if (utility.getObjectLength(definition) > 2) {
				// There are too many fields defined
				throw new Error();
			}

			if (! definition.hasOwnProperty('min')) {
				// The "min" label is not defined
				throw new Error();
			}

			if (! definition.hasOwnProperty('max')) {
				// The "max" label is not defined
				throw new Error();
			}

			// Checks if the values represent integers
			for (var label in definition) {
				if (! definition.hasOwnProperty(label)) {
					continue;
				}
				
				if (! utility.isStringAnInteger(definition[label])) {
					// The value doesn't represent an integer
					throw new Error();
				}
			}

			// Converts the values to integer
			definition = utility.filterObject(definition, utility.stringToInteger);

			if (definition.max < definition.min) {
				// The maximum value is lower than the minimum
				throw new Error();
			}

			return definition;
		};
		
		// ---------------------------------------------------------------------
		
		return DataTypeInput;
	}
})();
