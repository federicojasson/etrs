<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\InputValidator\DataType;

/**
 * Responsible for validating values of the integer_range data-type.
 */
class IntegerRange extends DataType {
	
	/**
	 * Determines whether an input is valid.
	 * 
	 * Receives the input.
	 */
	public function isInputValid($input) {
		if (! is_integer($input)) {
			// The input is not an integer
			return false;
		}
		
		// Gets the definition
		$definition = $this->getDefinition();
		
		// Gets the minimum and maximum allowed values
		$minimumValue = $definition['min'];
		$maximumValue = $definition['max'];
		
		// Determines whether the input is in the specified range
		return inRange($input, $minimumValue, $maximumValue);
	}
	
}
