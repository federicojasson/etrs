<?php

/*
 * This manager offers functionality to validate the input.
 */
class ValidationManager extends Manager {
	
	/*
	 * Determines whether an input has a certain length.
	 * 
	 * It receives the input and the length.
	 * TODO: remove if not used
	 */
	public function hasLength($input, $length) {
		return strlen($input) === $length;
	}
	
	/*
	 * Determines whether the length of an input is shorter (or equal) than a
	 * certain maximum.
	 * 
	 * It receives the input and the maximum length.
	 * TODO: remove if not used
	 */
	public function hasMaximumLength($input, $maximumLength) {
		return strlen($input) <= $maximumLength;
	}
	
	/*
	 * Determines whether the length of an input is longer (or equal) than a
	 * certain minimum.
	 * 
	 * It receives the input and the minimum length.
	 */
	public function hasMinimumLength($input, $minimumLength) {
		return strlen($input) >= $minimumLength;
	}
	
	/*
	 * Determines whether the length of an input is in a certain range.
	 * 
	 * It receives the input, the minimum length and the maximum length.
	 * TODO: remove if not used
	 */
	public function hasMinimumAndMaximumLength($input, $minimumLength, $maximumLength) {
		$length = strlen($input);
		return $length >= $minimumLength && $length <= $maximumLength;
	}
	
	/*
	 * Determines whether the input has a certain JSON structure.
	 * 
	 * It receives the input and its expected JSON structure.
	 */
	public function hasValidJsonStructure($input, $jsonStructure) {
		// Gets the JSON structure's type
		$type = $jsonStructure[JSON_STRUCTURE_KEY_TYPE];
		
		// Calls the proper function depending on the type of the JSON structure
		switch ($type) {
			case JSON_STRUCTURE_TYPE_ARRAY: {
				return $this->hasValidJsonStructureArray($input, $jsonStructure[JSON_STRUCTURE_KEY_DEFINITION]);
			}
			
			case JSON_STRUCTURE_TYPE_OBJECT: {
				return $this->hasValidJsonStructureObject($input, $jsonStructure[JSON_STRUCTURE_KEY_DEFINITION]);
			}
			
			case JSON_STRUCTURE_TYPE_VALUE: {
				return $this->hasValidJsonStructureValue($input);
			}
		}
	}
	
	/*
	 * Determines whether the input matches a JSON array and recursively
	 * validates its elements.
	 * 
	 * It receives the input and the expected JSON structure of its elements.
	 */
	private function hasValidJsonStructureArray($input, $jsonStructure) {
		if (! is_array($input)) {
			// The input is not an array
			return false;
		}
		
		if (! $this->isSequentialArray($input)) {
			// The input is not a sequential array
			return false;
		}
		
		// Validates the elements recursively
		$count = count($input);
		for ($i = 0; $i < $count; $i++) {
			if (! $this->hasValidJsonStructure($input[$i], $jsonStructure)) {
				// The element didn't pass the validation
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Determines whether the input matches a JSON object and recursively
	 * validates its properties.
	 * 
	 * It receives the input and the expected JSON structure of its properties.
	 */
	private function hasValidJsonStructureObject($input, $jsonStructure) {
		if (! is_array($input)) {
			// The input is not an array
			return false;
		}
		
		// Validates the properties recursively
		foreach ($jsonStructure as $property => $propertyJsonStructure) {
			if (! isset($input[$property])) {
				// The property is not defined in the input
				return false;
			}
			
			if (! $this->hasValidJsonStructure($input[$property], $propertyJsonStructure)) {
				// The property didn't pass the validation
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Determines whether the input matches a JSON value.
	 * 
	 * It receives the input.
	 */
	private function hasValidJsonStructureValue($input) {
		if (is_array($input)) {
			// The input is an array
			return false;
		}
		
		return true;
	}
	
	/*
	 * Determines whether an array is sequential.
	 */
	private function isSequentialArray($array) {
		// Initializes an array with the sequential indices
		$indexArray = range(0, count($array) - 1);
		
		// Compares the keys of the array with the index array
		return array_keys($array) === $indexArray;
	}
	
}
