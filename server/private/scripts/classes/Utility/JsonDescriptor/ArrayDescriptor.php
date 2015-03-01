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

namespace App\Utility\JsonDescriptor;

/**
 * This class represents a JSON array descriptor.
 */
class ArrayDescriptor extends JsonDescriptor {
	
	/**
	 * Determines whether an input is valid.
	 * 
	 * Receives the input.
	 */
	public function isInputValid($input) {
		if (! is_array($input)) {
			// The input is not an array
			return false;
		}
		
		if (! isArraySequential($input)) {
			// The array is not sequential
			return false;
		}
		
		// Validates the elements of the array
		foreach ($input as $element) {
			// Validates the element recursively
			$valid = $this->definition->isInputValid($element);
			
			if (! $valid) {
				// The element is invalid
				return false;
			}
		}
		
		return true;
	}
	
}
