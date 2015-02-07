<?php

namespace App\Auxiliar\JsonStructureDescriptor;

/*
 * This class represents a descriptor of a JSON array. Instances can be used to
 * validate inputs.
 */
class JsonArrayDescriptor extends JsonStructureDescriptor {
	
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
		
		if (! isSequentialArray($input)) {
			// The input is not a sequential array
			return false;
		}
		
		// Validates the array's elements
		foreach ($input as $element) {
			// Validates the element recursively
			$valid = $this->definition->isValidInput($element);
			
			if (! $valid) {
				// The element is invalid
				return false;
			}
		}
		
		return true;
	}
	
}
