<?php

namespace App\Auxiliar\DataTypeDescriptor;

/*
 * TODO: comments
 */
class IntegerFixValuesDescriptor extends DataTypeDescriptor {
	
	/*
	 * Determines whether an input is valid according to this descriptor.
	 * 
	 * It receives the input.
	 */
	public function isValidInput($input) {
		return isValueInArray($input, $this->definition);
	}
	
}
