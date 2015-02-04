<?php

namespace App\Helper;

/*
 * This helper offers input validation functions.
 */
class InputValidator extends Helper {
	
	/*
	 * Determines whether an input is a bounded integer.
	 * 
	 * It receives the input, the minimum allowed value and, optionally, the
	 * maximum allowed value.
	 */
	public function isBoundedInteger($input, $minimumValue, $maximumValue = PHP_INT_MAX) {
		if (! is_int($input)) {
			// The input is not an integer
			return false;
		}
		
		// Checks whether the input's value is in range
		return	$input >= $minimumValue &&
				$input <= $maximumValue;
	}
	
	/*
	 * Determines whether an input is a bounded string.
	 * 
	 * It receives the input, the minimum allowed length and, optionally, the
	 * maximum allowed length.
	 */
	public function isBoundedString($input, $minimumLength, $maximumLength = PHP_INT_MAX) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Gets the input's length
		$length = getStringLength($input);
		
		// Checks whether the input's length is in range
		return	$length >= $minimumLength &&
				$length <= $maximumLength;
	}
	
	/*
	 * Determines whether an input is a data type descriptor.
	 * 
	 * It receives the input.
	 */
	public function isDataTypeDescriptor($input) {
		if (! $this->isValidText($input, 0, 1024)) {
			// The input is not a valid text
			return false;
		}
		
		try {
			// Tries to create a data type descriptor
			\App\Auxiliar\DataTypeDescriptor\Factory::create($input);
			
			// The operation succeeded
			return true;
		} catch (\Exception $exception) {
			// The operation failed
			return false;
		}
	}
	
	/*
	 * Determines whether an input is a date.
	 * 
	 * It receives the input.
	 */
	public function isDate($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		$matches = [];
		if (! preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $input, $matches)) {
			// The input doesn't match the regular expression
			return false;
		}
		
		// Gets the day, the month and the year
		$day = $matches[3];
		$month = $matches[2];
		$year = $matches[1];

		// Checks the validity of the date according to the calendar
		return checkdate($month, $day, $year);
	}
	
	/*
	 * Determines whether an input is a gender.
	 * 
	 * It receives the input.
	 */
	public function isGender($input) {
		return isElementInArray($input, [
			GENDER_FEMALE,
			GENDER_MALE
		]);
	}
	
	/*
	 * Determines whether an input is a random ID.
	 * 
	 * It receives the input.
	 */
	public function isRandomId($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input matches a regular expression
		return preg_match('/^[0-9A-Fa-f]{' . 2 * RANDOM_ID_LENGTH . '}$/', $input);
	}
	
	/*
	 * Determines whether an input is a sorting order.
	 * 
	 * It receives the input.
	 */
	public function isSortingOrder($input) {
		return isElementInArray($input, [
			SORTING_ORDER_ASCENDING,
			SORTING_ORDER_DESCENDING
		]);
	}
	
	/*
	 * Determines whether an input is a valid text.
	 * 
	 * It receives the input, the minimum allowed length and, optionally, the
	 * maximum allowed length.
	 */
	public function isValidText($input, $minimumLength, $maximumLength = PHP_INT_MAX) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		if (! preg_match('/^[^\p{Cc}]*$/u', $input)) {
			// The input contains non-printable characters
			return false;
		}
		
		// Trims the input
		$input = trimString($input);
		
		// Checks whether the input is bounded
		return $this->isBoundedString($input, $minimumLength, $maximumLength);
	}
	
}
