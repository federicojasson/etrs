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
	 * Determines whether an input is a valid JSON structure according to this
	 * descriptor.
	 * 
	 * It receives the input.
	 */
	public function isValidJsonStructure($input) {
		// Calls the proper function depending on the type
		switch ($this->type) {
			case JSON_STRUCTURE_TYPE_ARRAY: {
				return $this->isValidJsonArray($input);
			}
			
			case JSON_STRUCTURE_TYPE_OBJECT: {
				return $this->isValidJsonObject($input);
			}
			
			case JSON_STRUCTURE_TYPE_VALUE: {
				return $this->isValidJsonValue($input);
			}
		}
	}
	
	/*
	 * Determines whether an input is a valid JSON array according to this
	 * descriptor.
	 * 
	 * It receives the input.
	 */
	private function isValidJsonArray($input) {
		if (! is_array($input)) {
			// The input is not an array
			return false;
		}
		
		if (! isSequentialArray($input)) {
			// The input is not a sequential array
			return false;
		}
		
		// Validates the array's elements
		foreach ($input as $element) {
			// Validates the element recursively
			$isValid = $this->definition->isValidJsonStructure($element);
			
			if (! $isValid) {
				// The element is invalid
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Determines whether an input is a valid JSON object according to this
	 * descriptor.
	 * 
	 * It receives the input.
	 */
	private function isValidJsonObject($input) {
		if (! is_array($input)) {
			// The input is not an array
			return false;
		}
		
		// Validates the object's properties
		foreach ($this->definition as $property => $jsonStructureDescriptor) {
			if (! array_key_exists($property, $input)) {
				// The property is not defined in the input
				return false;
			}
			
			// Validates the property recursively
			$isValid = $jsonStructureDescriptor->isValidJsonStructure($input[$property]);
			
			if (! $isValid) {
				// The property is invalid
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Determines whether an input is a valid JSON value according to this
	 * descriptor.
	 * 
	 * It receives the input.
	 */
	private function isValidJsonValue($input) {
		if (is_array($input)) {
			// The input is an array
			return false;
		}
		
		// Calls the validation function and returns the result
		return call_user_func($this->definition, $input);
	}
	
}
