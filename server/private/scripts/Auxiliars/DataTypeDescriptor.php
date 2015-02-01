<?php

namespace App\Auxiliars;

/*
 * This class represents a descriptor of a data type. Instances can be used to
 * validate values.
 * 
 * A descriptor consists of a type that indicates what kind of values are valid
 * and a definition that describes additional properties. The following diagram
 * represents its structure:
 * 
 *  --------- -------------------------------------------------------
 * |  type   |                      definition                       |
 *  --------- -------------------------------------------------------
 * | field 0 | field 1 | field 2 | field 3 | field 4 | ... | field n |
 *  --------- -------------------------------------------------------
 * 
 * To create instances of this class, a formatted descriptor is used, which
 * should respect the following rules:
 * 
 * - The fields must be separated by semicolons (;).
 * - The type field must indicate one of the predefined data types.
 * - The definition fields must be of the form <label> : <value>. Each label
 *   should be a non-empty unique string and each value a non-empty string.
 * 
 * Following are described the predefined data types and their rules:
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
 *   value. Also, the relation maximum >= minimum must be observed.
 *   Example: integer_range ; min: -5 ; max: 3
 */
class DataTypeDescriptor {
	
	/*
	 * The definition.
	 */
	private $definition;
	
	/*
	 * The type.
	 */
	private $type;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives a formatted descriptor.
	 * 
	 * Throws an exception if the descriptor can't be initialized.
	 */
	public function __construct($formattedDescriptor) {
		// Gets the fields of the descriptor
		$fields = $this->getFields($formattedDescriptor);
		
		// Initializes the type
		$this->initializeType($fields);
		
		// Initializes the definition
		$this->initializeDefinition($fields);
	}
	
	/*
	 * Determines whether an input is a valid value according to this
	 * descriptor.
	 * 
	 * It receives the input.
	 */
	public function isValidValue($input) {
		// Calls the proper function depending on the type
		switch ($this->type) {
			case DATA_TYPE_BOOLEAN: {
				return $this->isValidBooleanValue($input);
			}
			
			case DATA_TYPE_INTEGER_FIX_VALUES: {
				return $this->isValidIntegerFixValuesValue($input);
			}
			
			case DATA_TYPE_INTEGER_RANGE: {
				return $this->isValidIntegerRangeValue($input);
			}
		}
	}
	
	/*
	 * Returns the fields of a formatted descriptor.
	 * 
	 * It receives the formatted descriptor.
	 */
	private function getFields($formattedDescriptor) {
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
	private function getSubfields($field) {
		// Splits the field
		$subfields = explode(':', $field);
		
		// Trims the subfields
		foreach ($subfields as &$subfield) {
			$subfield = trimString($subfield);
		}
		
		return $subfields;
	}
	
	/*
	 * Initializes the definition of the descriptor.
	 * 
	 * It receives the fields.
	 * 
	 * Throws an exception if the definition can't be initialized.
	 */
	private function initializeDefinition($fields) {
		// Initializes the definition
		$definition = [];
		
		// Processes all the fields except the first one
		$count = count($fields);
		for ($i = 1; $i < $count; $i++) {
			// Gets the subfields of the field
			$subfields = $this->getSubfields($fields[$i]);
			
			if (count($subfields) !== 2) {
				// There should be 2 subfields per field
				throw new Exception();
			}
			
			// Gets the label and the value
			$label = $subfields[0];
			$value = $subfields[1];
			
			if (isStringEmpty($label)) {
				// The label is an empty string
				throw new Exception();
			}
			
			if (isStringEmpty($value)) {
				// The value is an empty string
				throw new Exception();
			}
			
			if (array_key_exists($label, $definition)) {
				// An entry with the same label has already been added
				throw new Exception();
			}
			
			// Adds an entry to the definition
			$definition[$label] = $value;
		}
		
		// Gets the first field
		$type = $fields[0];
		
		// Validates the definition according to the type of the descriptor
		switch ($type) {
			case DATA_TYPE_BOOLEAN: {
				$definition = $this->validateBooleanDefinition($definition);
				break;
			}
			
			case DATA_TYPE_INTEGER_FIX_VALUES: {
				$definition = $this->validateIntegerFixValuesDefinition($definition);
				break;
			}
			
			case DATA_TYPE_INTEGER_RANGE: {
				$definition = $this->validateIntegerRangeDefinition($definition);
				break;
			}
		}
		
		// Initializes the instance attribute
		$this->definition = $definition;
	}
	
	/*
	 * Initializes the type of the descriptor.
	 * 
	 * It receives the fields.
	 * 
	 * Throws an exception if the type can't be initialized.
	 */
	private function initializeType($fields) {
		// Gets the first field
		$type = $fields[0];
		
		// Defines the accepted data types
		$dataTypes = [
			DATA_TYPE_BOOLEAN,
			DATA_TYPE_INTEGER_FIX_VALUES,
			DATA_TYPE_INTEGER_RANGE
		];
		
		if (! isValueInArray($type, $dataTypes)) {
			// The type of the descriptor is not supported
			throw new Exception();
		}
		
		// Initializes the instance attribute
		$this->type = $type;
	}
	
	/*
	 * Determines whether an input is a valid boolean value.
	 * 
	 * It receives the input.
	 */
	private function isValidBooleanValue($input) {
		return isValueInArray($input, $this->definition);
	}
	
	/*
	 * Determines whether an input is a valid integer_fix_values value.
	 * 
	 * It receives the input.
	 */
	private function isValidIntegerFixValuesValue($input) {
		return isValueInArray($input, $this->definition);
	}
	
	/*
	 * Determines whether an input is a valid integer_range value.
	 * 
	 * It receives the input.
	 */
	private function isValidIntegerRangeValue($input) {
		if (! is_int($input)) {
			// The input is not an integer
			return false;
		}
		
		// Gets the minimum and maximum allowed value
		$minimumValue = $this->definition['min'];
		$maximumValue = $this->definition['max'];
		
		// Checks whether the input's value is in range
		return	$input >= $minimumValue &&
				$input <= $maximumValue;
	}
	
	/*
	 * Validates the definition of a boolean data type, modifies it properly and
	 * returns the result.
	 * 
	 * It receives the definition.
	 * 
	 * Throws an exception if the definition can't be validated.
	 */
	private function validateBooleanDefinition($definition) {
		if (count($definition) !== 2) {
			// The definition doesn't contain exactly 2 entries
			throw new Exception();
		}
		
		if (! isValueInArray('false', $definition)) {
			// The 'false' value is not present in the definition
			throw new Exception();
		}
		
		if (! isValueInArray('true', $definition)) {
			// The 'true' value is not present in the definition
			throw new Exception();
		}
		
		// Casts the values
		foreach ($definition as &$value) {
			$value = stringToBoolean($value);
		}
		
		return $definition;
	}
	
	/*
	 * Validates the definition of a integer_fix_values data type, modifies it
	 * properly and returns the result.
	 * 
	 * It receives the definition.
	 * 
	 * Throws an exception if the definition can't be validated.
	 */
	private function validateIntegerFixValuesDefinition($definition) {
		if (count($definition) === 0) {
			// The definition contains no entries
			throw new Exception();
		}
		
		foreach ($definition as $value) {
			if (! isStringInteger($value)) {
				// The value is not an integer
				throw new Exception();
			}
		}
		
		if (arrayContainsDuplicateElements($definition)) {
			// The definition contains duplicate values
			throw new Exception();
		}
		
		// Casts the values
		foreach ($definition as &$value) {
			$value = (int) $value;
		}
		
		return $definition;
	}
	
	/*
	 * Validates the definition of a integer_range data type, modifies it
	 * properly and returns the result.
	 * 
	 * It receives the definition.
	 * 
	 * Throws an exception if the definition can't be validated.
	 */
	private function validateIntegerRangeDefinition($definition) {
		if (count($definition) !== 2) {
			// The definition doesn't contain exactly 2 entries
			throw new Exception();
		}
		
		if (! array_key_exists('min', $definition)) {
			// The 'min' label is not present in the definition
			throw new Exception();
		}
		
		if (! array_key_exists('max', $definition)) {
			// The 'max' label is not present in the definition
			throw new Exception();
		}
		
		foreach ($definition as $value) {
			if (! isStringInteger($value)) {
				// The value is not an integer
				throw new Exception();
			}
		}
		
		// Casts the values
		foreach ($definition as &$value) {
			$value = (int) $value;
		}
		
		if ($definition['max'] < $definition['min']) {
			// The maximum allowed value is lower than the minimum
			throw new Exception();
		}
		
		return $definition;
	}
	
}
