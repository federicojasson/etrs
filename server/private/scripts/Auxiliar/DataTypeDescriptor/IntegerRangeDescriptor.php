<?php

namespace App\Auxiliar\DataTypeDescriptor;

/*
 * This class represents a descriptor of the integer_range data type. Instances
 * can be used to validate inputs.
 */
class IntegerRangeDescriptor extends DataTypeDescriptor {
	
	/*
	 * Determines whether an input is valid according to this descriptor.
	 * 
	 * It receives the input.
	 */
	public function isValidInput($input) {
		if (! is_int($input)) {
			// The input is not an integer
			return false;
		}
		
		// Gets the minimum and maximum allowed value
		$minimumValue = $this->definition['min'];
		$maximumValue = $this->definition['max'];
		
		// Checks whether the input's value is in range
		return	$input >= $minimumValue &&
				$input <= $maximumValue;
	}
	
}
