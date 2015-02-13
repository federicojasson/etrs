<?php

namespace App\Auxiliar\DataTypeDescriptor;

/*
 * This class represents a descriptor of the boolean data type.
 * 
 * Instances of this class can be used to validate inputs.
 */
class BooleanDescriptor extends DataTypeDescriptor {
	
	/*
	 * Determines whether an input is valid according to this descriptor.
	 * 
	 * It receives the input.
	 */
	public function isValidInput($input) {
		return isElementInArray($input, $this->definition);
	}
	
}
