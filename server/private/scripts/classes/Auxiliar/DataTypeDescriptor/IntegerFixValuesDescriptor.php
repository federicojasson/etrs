<?php

namespace App\Auxiliar\DataTypeDescriptor;

/*
 * This class represents a descriptor of the integer_fix_values data type.
 * Instances can be used to validate inputs.
 */
class IntegerFixValuesDescriptor extends DataTypeDescriptor {
	
	/*
	 * Determines whether an input is valid according to this descriptor.
	 * 
	 * It receives the input.
	 */
	public function isValidInput($input) {
		return isElementInArray($input, $this->definition);
	}
	
}
