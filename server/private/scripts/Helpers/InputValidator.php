<?php

/*
 * TODO: comments
 */
class InputValidator extends Helper {
	
	/*
	 * Validates a JSON request and returns the result.
	 * 
	 * If the request is valid, the decoded input is returned in the last
	 * parameter.
	 * 
	 * It receives the request and the description of the expected JSON
	 * structure.
	 */
	public function validateJsonRequest($request, $jsonStructureDescription, &$input) {
		// Gets the content type
		$contentType = $request->headers->get(HTTP_HEADER_CONTENT_TYPE);
		
		if ($contentType !== HTTP_CONTENT_TYPE_JSON) {
			// The content type is not JSON
			return false;
		}
		
		// Gets the encoded input
		$encodedInput = $request->getBody();
		
		// Decodes the input
		$input = json_decode($encodedInput, true);
		
		if (is_null($input)) {
			// The input could not be decoded
			return false;
		}
		
		if (! $this->validateJsonStructure($input, $jsonStructureDescription)) {
			// The input didn't pass the validation
			return false;
		}
		
		return true;
	}
	
	/*
	 * Validates an input, checking if it has a certain JSON structure.
	 * 
	 * It receives the input and the description of the JSON structure.
	 */
	private function validateJsonStructure($input, $jsonStructureDescription) {
		// Gets the JSON structure's definition and type
		$definition = $jsonStructureDescription->getDefinition();
		$type = $jsonStructureDescription->getType();
		
		// Calls the proper function depending on the type of the JSON structure
		switch ($type) {
			case JSON_STRUCTURE_TYPE_ARRAY: {
				return $this->validateJsonStructureArray($input, $definition);
			}
			
			case JSON_STRUCTURE_TYPE_OBJECT: {
				return $this->validateJsonStructureObject($input, $definition);
			}
			
			case JSON_STRUCTURE_TYPE_VALUE: {
				return $this->validateJsonStructureValue($input, $definition);
			}
		}
	}
	
	/*
	 * Validates an input, checking if it matches a JSON array and recursively
	 * validating its elements.
	 * 
	 * It receives the input and the description of the JSON structure expected
	 * in its elements.
	 */
	private function validateJsonStructureArray($input, $jsonStructureDescription) {
		if (! is_array($input)) {
			// The input is not an array
			return false;
		}
		
		if (! $this->isSequentialArray($input)) {
			// The input is not a sequential array
			return false;
		}
		
		// Validates the array's elements recursively
		$count = count($input);
		for ($i = 0; $i < $count; $i++) {
			// Validates the element
			$isValid = $this->validateJsonStructure($input[$i], $jsonStructureDescription);
			
			if (! $isValid) {
				// The element didn't pass the validation
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Validates an input, checking if it matches a JSON object and recursively
	 * validating its properties.
	 * 
	 * It receives the input and the descriptions of the JSON structures
	 * expected in its elements (in an associative array).
	 */
	private function validateJsonStructureObject($input, $jsonStructureDescriptions) {
		if (! is_array($input)) {
			// The input is not an array
			return false;
		}
		
		// Validates the object's properties recursively
		foreach ($jsonStructureDescriptions as $property => $propertyJsonStructureDescription) {
			if (! isset($input[$property])) {
				// The property is not defined in the input
				return false;
			}
			
			// Validates the property
			$isValid = $this->validateJsonStructure($input[$property], $propertyJsonStructureDescription);
			
			if (! $isValid) {
				// The property didn't pass the validation
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Validates an input, checking if it matches a JSON value and validating it
	 * as well.
	 * 
	 * It receives the input and its validation function.
	 */
	private function validateJsonStructureValue($input, $validationFunction) {
		if (is_array($input)) {
			// The input is an array
			return false;
		}
		
		// Calls the validation function and returns the result
		return call_user_func($validationFunction, $input);
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
