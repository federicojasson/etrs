<?php

namespace App\Auxiliar\JsonStructureDescriptor;

/*
 * This class represents a descriptor of a JSON value. Instances can be used to
 * validate inputs.
 */
class JsonValueDescriptor extends JsonStructureDescriptor {
	
	/*
	 * Determines whether an input is valid according to this descriptor.
	 * 
	 * It receives the input.
	 */
	public function isValidInput($input) {
		if (is_array($input)) {
			// The input is an array
			return false;
		}
		
		// Calls the validation function and returns the result
		return call_user_func($this->definition, $input);
	}
	
}
