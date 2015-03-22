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

namespace App\Helper;

/**
 * Provides input-validation methods.
 */
class InputValidator {
	
	/**
	 * Determines whether a JSON input is valid.
	 * 
	 * Receives the input and a JSON input validator.
	 */
	public function isJsonInputValid($input, $jsonInputValidator) {
		if (is_null($input)) {
			// The input could not be decoded
			return false;
		}
		
		// Validates the input
		return $jsonInputValidator->isInputValid($input);
	}
	
	/**
	 * Determines whether an input is a random ID.
	 * 
	 * Receives the input.
	 */
	public function isRandomId($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Determines whether the input matches a regular expression
		return preg_match('/^[0-9A-Fa-f]{' . 2 * RANDOM_ID_LENGTH . '}$/', $input);
	}
	
	/**
	 * Determines whether an input is a random password.
	 * 
	 * Receives the input.
	 */
	public function isRandomPassword($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Determines whether the input matches a regular expression
		return preg_match('/^[0-9A-Fa-f]{' . 2 * RANDOM_PASSWORD_LENGTH . '}$/', $input);
	}
	
	/**
	 * Determines whether an input is a valid integer.
	 * 
	 * Receives the input, the minimum allowed value and, optionally, the
	 * maximum.
	 */
	public function isValidInteger($input, $minimumValue, $maximumValue = null) {
		if (! is_integer($input)) {
			// The input is not an integer
			return false;
		}
		
		// Determines whether the value is in the specified range
		return inRange($input, $minimumValue, $maximumValue);
	}
	
	/**
	 * Determines whether an input is a valid line.
	 * 
	 * An input is considered a valid line if it contains only printable
	 * characters and is a valid string after trimming it and shrinking it.
	 * 
	 * Receives the input, the minimum allowed length and, optionally, the
	 * maximum.
	 */
	public function isValidLine($input, $minimumLength, $maximumLength = null) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		if (preg_match('/\p{Cc}/', $input)) {
			// The input contains control characters
			return false;
		}
		
		// Trims and shrinks the input
		$input = trimAndShrink($input);
		
		// Gets the input's length
		$length = mb_strlen($input, 'UTF-8');
		
		// Determines whether the length is in the specified range
		return inRange($length, $minimumLength, $maximumLength);
	}
	
	/**
	 * Determines whether an input is a valid string.
	 * 
	 * Receives the input, the minimum allowed length and, optionally, the
	 * maximum.
	 */
	public function isValidString($input, $minimumLength, $maximumLength = null) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Gets the input's length
		$length = mb_strlen($input, 'UTF-8');
		
		// Determines whether the length is in the specified range
		return inRange($length, $minimumLength, $maximumLength);
	}
	
}
