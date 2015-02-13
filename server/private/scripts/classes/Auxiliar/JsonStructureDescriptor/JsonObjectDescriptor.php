<?php

namespace App\Auxiliar\JsonStructureDescriptor;

/*
 * This class represents a descriptor of a JSON object.
 * 
 * Instances of this class can be used to validate inputs.
 */
class JsonObjectDescriptor extends JsonStructureDescriptor {
	
	/*
	 * Determines whether an input is valid according to this descriptor.
	 * 
	 * It receives the input.
	 */
	public function isValidInput($input) {
		if (! is_array($input)) {
			// The input is not an array
			return false;
		}
		
		// Validates the object's properties
		foreach ($this->definition as $property => $jsonStructureDescriptor) {
			if (! array_key_exists($property, $input)) {
				// The property is not defined in the object
				return false;
			}
			
			// Validates the property recursively
			$valid = $jsonStructureDescriptor->isValidInput($input[$property]);
			
			if (! $valid) {
				// The property is invalid
				return false;
			}
		}
		
		return true;
	}
	
}
