<?php

namespace App\Auxiliar\DataTypeDescriptor;

/*
 * This class offers methods to create data type descriptors.
 * 
 * Descriptors can be created by specifying a string consisting of a type, that
 * indicates what kind of values are valid, and a definition, that describes
 * additional properties. The following diagram represents the expected
 * structure:
 * 
 *  --------- -------------------------------------------------------
 * |  type   |                      definition                       |
 *  --------- -------------------------------------------------------
 * | field 0 | field 1 | field 2 | field 3 | field 4 | ... | field n |
 *  --------- -------------------------------------------------------
 * 
 * The following rules should be respected:
 * 
 * - The fields must be separated by semicolons (;).
 * - The type field must indicate one of the predefined data types.
 * - The definition fields must be of the form <label> : <value>. Each label
 *   should be a non-empty unique string and each value a non-empty string.
 * 
 * Following are described the predefined data types and their specific
 * requirements:
 * 
 * - boolean
 *   It should have exactly 2 definition fields and the values 'false' and
 *   'true' must be included, one for each field.
 *   Example: boolean ; Yes: true ; No: false
 * 
 * - integer_fix_values
 *   It should have at least 1 definition field and the values should be unique
 *   integers.
 *   Example: integer_fix_values ; Red: 1 ; Green: 2 ; Blue: 3
 * 
 * - integer_range
 *   It should have exactly 2 definition fields and the labels 'min' and 'max'
 *   must be included, one for each field. Both values should be integers. The
 *   one corresponding to the 'min' label defines the minimum allowed value,
 *   while the one corresponding to the 'max' label defines the maximum allowed
 *   value. The relation maximum >= minimum must be observed.
 *   Example: integer_range ; min: -5 ; max: 3
 */
class Factory {
	
	/*
	 * Creates a DataTypeDescriptor instance.
	 * 
	 * It receives a formatted descriptor.
	 * 
	 * Throws an exception if the operation fails.
	 */
	public static function create($formattedDescriptor) {
		// Gets the fields of the descriptor
		$fields = static::getFields($formattedDescriptor);
		
		// Gets the type
		$type = static::getType($fields);
		
		// Gets the definition
		$definition = static::getDefinition($fields);
		
		// Creates and returns the proper instance according to the type of the
		// descriptor
		switch ($type) {
			case DATA_TYPE_BOOLEAN: {
				return new BooleanDescriptor($definition);
			}
			
			case DATA_TYPE_INTEGER_FIX_VALUES: {
				return new IntegerFixValuesDescriptor($definition);
			}
			
			case DATA_TYPE_INTEGER_RANGE: {
				return new IntegerRangeDescriptor($definition);
			}
		}
	}
	
	/*
	 * Returns the definition of a descriptor from its fields.
	 * 
	 * It receives the fields.
	 * 
	 * Throws an exception if the operation fails.
	 */
	private static function getDefinition($fields) {
		// Initializes the definition
		$definition = [];
		
		// Processes all the fields except the first one
		$count = count($fields);
		for ($i = 1; $i < $count; $i++) {
			// Gets the subfields of the field
			$subfields = static::getSubfields($fields[$i]);
			
			if (count($subfields) !== 2) {
				// There should be 2 subfields per field
				throw new \Exception();
			}
			
			// Gets the label and the value
			$label = $subfields[0];
			$value = $subfields[1];
			
			if (isStringEmpty($label)) {
				// The label is an empty string
				throw new \Exception();
			}
			
			if (isStringEmpty($value)) {
				// The value is an empty string
				throw new \Exception();
			}
			
			if (array_key_exists($label, $definition)) {
				// An entry with the same label has already been added
				throw new \Exception();
			}
			
			// Adds an entry to the definition
			$definition[$label] = $value;
		}
		
		// Gets the first field
		$type = $fields[0];
		
		// Processes the definition according to the type of the descriptor
		switch ($type) {
			case DATA_TYPE_BOOLEAN: {
				$definition = static::processBooleanDefinition($definition);
				break;
			}
			
			case DATA_TYPE_INTEGER_FIX_VALUES: {
				$definition = static::processIntegerFixValuesDefinition($definition);
				break;
			}
			
			case DATA_TYPE_INTEGER_RANGE: {
				$definition = static::processIntegerRangeDefinition($definition);
				break;
			}
		}
		
		return $definition;
	}
	
	/*
	 * Returns the fields of a formatted descriptor.
	 * 
	 * It receives the formatted descriptor.
	 */
	private static function getFields($formattedDescriptor) {
		// Splits the formatted descriptor
		$fields = explode(';', $formattedDescriptor);
		
		// Trims the fields
		foreach ($fields as &$field) {
			$field = trimString($field);
		}
		
		return $fields;
	}
	
	/*
	 * Returns the subfields of a field.
	 * 
	 * It receives the field.
	 */
	private static function getSubfields($field) {
		// Splits the field
		$subfields = explode(':', $field);
		
		// Trims the subfields
		foreach ($subfields as &$subfield) {
			$subfield = trimString($subfield);
		}
		
		return $subfields;
	}
	
	/*
	 * Returns the type of a descriptor from its fields.
	 * 
	 * It receives the fields.
	 * 
	 * Throws an exception if the operation fails.
	 */
	private static function getType($fields) {
		// Gets the first field
		$type = $fields[0];
		
		// Defines the supported types
		$types = [
			DATA_TYPE_BOOLEAN,
			DATA_TYPE_INTEGER_FIX_VALUES,
			DATA_TYPE_INTEGER_RANGE
		];
		
		if (! isElementInArray($type, $types)) {
			// The type of the descriptor is not supported
			throw new \Exception();
		}
		
		return $type;
	}
	
	/*
	 * Processes the definition of a boolean data type and returns the result.
	 * 
	 * It receives the definition.
	 * 
	 * Throws an exception if the operation fails.
	 */
	private static function processBooleanDefinition($definition) {
		if (count($definition) !== 2) {
			// The definition doesn't contain exactly 2 entries
			throw new \Exception();
		}
		
		if (! isElementInArray('false', $definition)) {
			// The 'false' value is not present in the definition
			throw new \Exception();
		}
		
		if (! isElementInArray('true', $definition)) {
			// The 'true' value is not present in the definition
			throw new \Exception();
		}
		
		// Casts the values
		foreach ($definition as &$value) {
			$value = stringToBoolean($value);
		}
		
		return $definition;
	}
	
	/*
	 * Processes the definition of a integer_fix_values data type and returns
	 * the result.
	 * 
	 * It receives the definition.
	 * 
	 * Throws an exception if the operation fails.
	 */
	private static function processIntegerFixValuesDefinition($definition) {
		if (count($definition) === 0) {
			// The definition contains no entries
			throw new \Exception();
		}
		
		foreach ($definition as $value) {
			if (! isStringInteger($value)) {
				// The value is not an integer
				throw new \Exception();
			}
		}
		
		if (arrayContainsDuplicateElements($definition)) {
			// The definition contains duplicate values
			throw new \Exception();
		}
		
		// Casts the values
		foreach ($definition as &$value) {
			$value = (int) $value;
		}
		
		return $definition;
	}
	
	/*
	 * Processes the definition of a integer_range data type and returns the
	 * result.
	 * 
	 * It receives the definition.
	 * 
	 * Throws an exception if the operation fails.
	 */
	private static function processIntegerRangeDefinition($definition) {
		if (count($definition) !== 2) {
			// The definition doesn't contain exactly 2 entries
			throw new \Exception();
		}
		
		if (! array_key_exists('min', $definition)) {
			// The 'min' label is not present in the definition
			throw new \Exception();
		}
		
		if (! array_key_exists('max', $definition)) {
			// The 'max' label is not present in the definition
			throw new \Exception();
		}
		
		foreach ($definition as $value) {
			if (! isStringInteger($value)) {
				// The value is not an integer
				throw new \Exception();
			}
		}
		
		// Casts the values
		foreach ($definition as &$value) {
			$value = (int) $value;
		}
		
		// Gets the minimum and maximum allowed value
		$minimumValue = $definition['min'];
		$maximumValue = $definition['max'];
		
		if ($maximumValue < $minimumValue) {
			// The maximum allowed value is lower than the minimum
			throw new \Exception();
		}
		
		return $definition;
	}
	
}
