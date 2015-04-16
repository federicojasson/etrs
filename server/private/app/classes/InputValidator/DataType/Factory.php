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
 * - The fields must consist of exactly 2 subfields, separated by colons (:).
 * - The data type must be one of the predefined.
 * - The definition fields must be of the form <label>: <value>. Each label must
 *   be a non-empty unique string and each value a non-empty string.
 * 
 * Following are described the predefined data types and their requirements:
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
		// TODO
		
		$dataType = $fields[0];
		
		$dataTypes = [
			DATA_TYPE_BOOLEAN,
			DATA_TYPE_INTEGER_FIX_VALUES,
			DATA_TYPE_INTEGER_RANGE
		];
		
		if (! inArray($dataType, $dataTypes)) {
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
		// TODO: comments
		
		$definition = [];
		
		$count = count($fields);
		for ($i = 1; $i < $count; $i++) {
			$field = $fields[$i];
			$subfields = self::getSubfields($field);
			
			$label = $subfields[0];
			$value = $subfields[1];
			
			if (array_key_exists($label, $definition)) {
				throw new InvalidDefinitionException('Duplicate label.');
			}
			
			$definition[$label] = $value;
		}
		
		$dataType = $fields[0];
		
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
		// TODO: comments
		
		$fields = explode(';', $formattedDefinition);
		$filter = createArrayFilter('trimAndShrink');
		
		return call_user_func($filter, $fields);
	}
	
	/**
	 * Returns the subfields of a field.
	 * 
	 * Receives the field.
	 */
	private static function getSubfields($field) {
		// TODO: comments
		
		$subfields = explode(':', $field);
		
		if (count($subfields) !== 2) {
			throw new InvalidDefinitionException('Invalid field format.');
		}
		
		$filter = createArrayFilter('trimAndShrink');
		
		$subfields = call_user_func($filter, $subfields);
		
		$label = $subfields[0];
		
		if ($label === '') {
			throw new InvalidDefinitionException('Label not specified.');
		}
		
		$value = $subfields[1];
		
		if ($value === '') {
			throw new InvalidDefinitionException('Value not specified.');
		}
		
		return $subfields;
	}
	
	/**
	 * TODO: comment
	 * 
	 * Receives the definition.
	 */
	private static function processBooleanDefinition($definition) {
		// TODO: comments
		
		if (count($definition) !== 2) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		if (! inArray('false', $definition)) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		if (! inArray('true', $definition)) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		$filter = createArrayFilter('toBoolean'); // TODO: implement
		
		return call_user_func($filter, $definition);
	}
	
	/**
	 * TODO: comment
	 * 
	 * Receives the definition.
	 */
	private static function processIntegerFixValuesDefinition($definition) {
		// TODO: comments
		
		if (count($definition) === 0) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		foreach ($definition as $value) {
			// TODO check if is string integer
		}
		
		if (containsDuplicates($definition)) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		$filter = createArrayFilter('toInteger'); // TODO: implement
		
		return call_user_func($filter, $definition);
	}
	
	/**
	 * TODO: comment
	 * 
	 * Receives the definition.
	 */
	private static function processIntegerRangeDefinition($definition) {
		// TODO: comments
		
		if (count($definition) !== 2) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		if (! array_key_exists('min', $definition)) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		if (! array_key_exists('max', $definition)) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		foreach ($definition as $value) {
			// TODO check if is string integer
		}
		
		$filter = createArrayFilter('toInteger'); // TODO: implement
		
		$definition = call_user_func($filter, $definition);
		
		$minimumValue = $definition['min'];
		$maximumValue = $definition['max'];
		
		if ($maximumValue < $minimumValue) {
			throw new InvalidDefinitionException(); // TODO: message
		}
		
		return $definition;
	}
	
}
