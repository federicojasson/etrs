<?php

namespace App\Auxiliars;

/*
 * This class represents a descriptor of a JSON structure. Instances can be used
 * in combination to define the expected structure of a JSON input and
 * subsequently validating it.
 * 
 * A JSON structure descriptor holds the type of JSON structure that is supposed
 * to match against, which can be an array, an object or a value. For each type,
 * a definition indicates the way it should be validated:
 * 
 * - Arrays: a JsonStructureDescriptor instance is used, which describes the
 *   structure of all the array's elements.
 * 
 * - Objects: an associative array is used, whose values are
 *   JsonStructureDescriptor instances that describe the structure of each
 *   property.
 * 
 * - Values: a validation function is used, which is invoked in order to
 *   validate the value.
 */
class JsonStructureDescriptor {
	
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
	 * It receives the type and the definition.
	 */
	public function __construct($type, $definition) {
		$this->definition = $definition;
		$this->type = $type;
	}
	
	/*
	 * Validates a JSON structure.
	 * 
	 * It receives the JSON structure.
	 */
	public function validateJsonStructure($jsonStructure) {
		// Calls the proper function depending on the expected type
		switch ($this->type) {
			case JSON_STRUCTURE_TYPE_ARRAY: {
				return $this->validateJsonArray($jsonStructure);
			}
			
			case JSON_STRUCTURE_TYPE_OBJECT: {
				return $this->validateJsonObject($jsonStructure);
			}
			
			case JSON_STRUCTURE_TYPE_VALUE: {
				return $this->validateJsonValue($jsonStructure);
			}
		}
	}
	
	/*
	 * Validates a JSON array.
	 * 
	 * It receives the JSON array.
	 */
	private function validateJsonArray($jsonArray) {
		if (! is_array($jsonArray)) {
			// The input is not an array
			return false;
		}
		
		if (! isSequentialArray($jsonArray)) {
			// The input is not a sequential array
			return false;
		}
		
		// Validates the array's elements
		foreach ($jsonArray as $element) {
			// Validates the element recursively
			$isValid = $this->definition->validateJsonStructure($element);
			
			if (! $isValid) {
				// The element didn't pass the validation
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Validates a JSON object.
	 * 
	 * It receives the JSON object.
	 */
	private function validateJsonObject($jsonObject) {
		if (! is_array($jsonObject)) {
			// The input is not an array
			return false;
		}
		
		// Validates the object's properties
		foreach ($this->definition as $property => $jsonStructureDescriptor) {
			if (! isset($jsonObject[$property])) {
				// The property is not defined in the JSON object
				return false;
			}
			
			// Validates the property recursively
			$isValid = $jsonStructureDescriptor->validateJsonStructure($jsonObject[$property]);
			
			if (! $isValid) {
				// The property didn't pass the validation
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Validates a JSON value.
	 * 
	 * It receives the JSON value.
	 */
	private function validateJsonValue($jsonValue) {
		if (is_array($jsonValue)) {
			// The input is an array
			return false;
		}
		
		// Calls the validation function and returns the result
		return call_user_func($this->definition, $jsonValue);
	}
	
}
