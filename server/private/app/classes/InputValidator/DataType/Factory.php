<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\InputValidator\DataType;

/**
 * Responsible for creating data-type input validators.
 * 
 * Input validators can be created from a formatted definition consisting of a
 * data type, that indicates what kind of values are valid, and a definition,
 * that describes additional properties. The following diagram represents the
 * expected structure:
 * 
 * -------------------------------------------------------------------------
 * | data type |                        definition                         |
 * -------------------------------------------------------------------------
 * |  field 0  |  field 1  |  field 2  |  field 3  |    ...    |  field n  |
 * -------------------------------------------------------------------------
 * 
 * The following rules must be followed:
 * 
 * - The fields must be separated by semicolons (;).
 * - The data type must be one of the predefined.
 * - The definition fields must be of the form <label>: <value>. Each label must
 *   be a unique non-empty string and each value a non-empty string.
 * 
 * Following are described the predefined data types and their specific
 * requirements:
 * 
 * - boolean
 *   It must have exactly 2 definition fields and the values "false" and "true"
 *   have to be included, one in each field.
 *   Example: boolean; Yes: true; No: false
 * 
 * - integer_fix_values
 *   It must have at least 1 definition field and the values have to be unique
 *   integers.
 *   Example: integer_fix_values; Red: 1; Green: 2; Blue: 3
 * 
 * - integer_range
 *   It must have exactly 2 definition fields and the labels "min" and "max"
 *   have to be included, one in each field. Both values must be integers. The
 *   one corresponding to the "min" label defines the minimum allowed value,
 *   while the one of the "max" label defines the maximum. The relation
 *   maximum >= minimum must be observed.
 *   Example: integer_range; min: -5; max: 3
 */
class Factory {
	
	/**
	 * Creates a data-type input validator.
	 * 
	 * Receives a formatted definition.
	 * 
	 * Throws an exception if the creation fails.
	 */
	public static function create($formattedDefinition) {
		// Gets the fields
		$fields = self::getFields($formattedDefinition);
		
		// Gets the data type
		$dataType = self::getDataType($fields);
		
		// Gets the data type's class
		$class = self::getDataTypeClass($dataType);
		
		// Gets the definition
		$definition = self::getDefinition($fields);
		
		// Initializes the data-type input validator
		return new $class($definition);
	}
	
	/**
	 * Returns the data type from a set of fields.
	 * 
	 * Receives the fields.
	 */
	private static function getDataType($fields) {
		// Gets the data type
		$dataType = $fields[0];
		
		// Builds an array containing the data types
		$dataTypes = [
			DATA_TYPE_BOOLEAN,
			DATA_TYPE_INTEGER_FIX_VALUES,
			DATA_TYPE_INTEGER_RANGE
		];
		
		if (! inArray($dataType, $dataTypes)) {
			// The data type is invalid
			throw new InvalidDefinitionException('Invalid data type.');
		}
		
		return $dataType;
	}
	
	/**
	 * Returns a data type's class.
	 * 
	 * Receives the data type.
	 */
	private static function getDataTypeClass($dataType) {
		// Converts the data type from snake_case to PascalCase
		$dataType = snakeToPascalCase($dataType);
		
		// Builds the class
		return 'App\InputValidator\DataType\\' . $dataType;
	}
	
	/**
	 * Returns the definition from a set of fields.
	 * 
	 * Receives the fields.
	 */
	private static function getDefinition($fields) {
		$definition = [];
		
		// Adds all fields, except the first one, to the definition
		$count = count($fields);
		for ($i = 1; $i < $count; $i++) {
			$field = $fields[$i];
			
			// Gets the subfields
			$subfields = self::getSubfields($field);
			
			// Gets the label and value
			$label = $subfields[0];
			$value = $subfields[1];
			
			if (array_key_exists($label, $definition)) {
				// There is a duplicate label
				throw new InvalidDefinitionException('Duplicate label.');
			}
			
			// Adds the field to the definition
			$definition[$label] = $value;
		}
		
		// Gets the data type
		$dataType = $fields[0];
		
		// Processes the definition according to the data type
		switch ($dataType) {
			case DATA_TYPE_BOOLEAN: {
				return self::processBooleanDefinition($definition);
			}
			
			case DATA_TYPE_INTEGER_FIX_VALUES: {
				return self::processIntegerFixValuesDefinition($definition);
			}
			
			case DATA_TYPE_INTEGER_RANGE: {
				return self::processIntegerRangeDefinition($definition);
			}
		}
	}
	
	/**
	 * Returns the fields from a formatted definition.
	 * 
	 * Receives the formatted definition.
	 */
	private static function getFields($formattedDefinition) {
		// Gets the fields
		$fields = explode(';', $formattedDefinition);
		
		// Trims and shrinks the fields
		return filterArray($fields, 'trimAndShrink');
	}
	
	/**
	 * Returns the subfields of a field.
	 * 
	 * Receives the field.
	 */
	private static function getSubfields($field) {
		// Gets the subfields
		$subfields = explode(':', $field);
		
		if (count($subfields) !== 2) {
			// The field format is invalid
			throw new InvalidDefinitionException('Invalid field format.');
		}
		
		// Trims and shrinks the subfields
		$subfields = filterArray($subfields, 'trimAndShrink');
		
		// Gets the label
		$label = $subfields[0];
		
		if ($label === '') {
			// The label is not specified
			throw new InvalidDefinitionException('Label not specified.');
		}
		
		// Gets the value
		$value = $subfields[1];
		
		if ($value === '') {
			// The value is not specified
			throw new InvalidDefinitionException('Value not specified.');
		}
		
		return $subfields;
	}
	
	/**
	 * Processes a definition of the boolean data type.
	 * 
	 * Receives the definition.
	 */
	private static function processBooleanDefinition($definition) {
		if (count($definition) > 2) {
			// There are too many fields defined
			throw new InvalidDefinitionException('Too many fields defined.');
		}
		
		if (! inArray('false', $definition)) {
			// The "false" value is not defined
			throw new InvalidDefinitionException('"false" value not defined.');
		}
		
		if (! inArray('true', $definition)) {
			// The "true" value is not defined
			throw new InvalidDefinitionException('"true" value not defined.');
		}
		
		// Converts the values from string to boolean
		return filterArray($definition, 'stringToBoolean');
	}
	
	/**
	 * Processes a definition of the integer_fix_values data type.
	 * 
	 * Receives the definition.
	 */
	private static function processIntegerFixValuesDefinition($definition) {
		if (count($definition) === 0) {
			// There are no fields defined
			throw new InvalidDefinitionException('No fields defined.');
		}
		
		// Checks if the values represent integers
		foreach ($definition as $value) {
			if (! isStringAnInteger($value)) {
				// The value doesn't represent an integer
				throw new InvalidDefinitionException('Non-integer value.');
			}
		}
		
		if (containsDuplicates($definition)) {
			// There is a duplicate value
			throw new InvalidDefinitionException('Duplicate value.');
		}
		
		// Converts the values from string to integer
		return filterArray($definition, 'stringToInteger');
	}
	
	/**
	 * Processes a definition of the integer_range data type.
	 * 
	 * Receives the definition.
	 */
	private static function processIntegerRangeDefinition($definition) {
		if (count($definition) > 2) {
			// There are too many fields defined
			throw new InvalidDefinitionException('Too many fields defined.');
		}
		
		if (! array_key_exists('min', $definition)) {
			// The "min" label is not defined
			throw new InvalidDefinitionException('"min" label not defined.');
		}
		
		if (! array_key_exists('max', $definition)) {
			// The "max" label is not defined
			throw new InvalidDefinitionException('"max" label not defined.');
		}
		
		// Checks if the values represent integers
		foreach ($definition as $value) {
			if (! isStringAnInteger($value)) {
				// The value doesn't represent an integer
				throw new InvalidDefinitionException('Non-integer value.');
			}
		}
		
		// Converts the values from string to integer
		$definition = filterArray($definition, 'stringToInteger');
		
		// Gets the minimum and maximum values
		$minimumValue = $definition['min'];
		$maximumValue = $definition['max'];
		
		if ($maximumValue < $minimumValue) {
			// The maximum value is lower than the minimum
			throw new InvalidDefinitionException('Maximum value lower than the minimum.');
		}
		
		return $definition;
	}
	
}
