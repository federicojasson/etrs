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
		if (! $this->isBoundedString($input, 0, 1024)) {
			// The input is not a string or is not bounded properly
			return false;
		}
		
		try {
			// Tries to create a data type descriptor
			$app->dataTypeDescriptor->create($input);
			
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
		
		if (! preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $input, $matches)) {
			// The input doesn't match the regular expression
			return false;
		}
		
		// Gets the year, the month and the day
		$year = $matches[1];
		$month = $matches[2];
		$day = $matches[3];

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
	 * Determines whether an input is a printable string.
	 * 
	 * It receives the input.
	 */
	public function isPrintableString($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input matches a regular expression
		return preg_match('/^[^\p{Cc}]*$/u', $input);
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
		
		// Trims the input
		$input = trimString($input);
		
		return	$this->isBoundedString($input, $minimumLength, $maximumLength) &&
				$this->isPrintableString($input);
	}
	
	/*
	 * Validates a JSON request and returns the result.
	 * 
	 * If the request is valid, the input is replaced by a decoded version.
	 * 
	 * It receives the descriptor of the expected JSON structure.
	 */
	public function validateJsonRequest($jsonStructureDescriptor) {
		$app = $this->app;
		
		// Gets the media type
		$mediaType = $app->request->getMediaType();
		
		if ($mediaType !== 'application/json') {
			// The media type is not JSON
			return false;
		}
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Decodes the input
		$input = json_decode($input, true);
		
		if (is_null($input)) {
			// The input could not be decoded
			return false;
		}
		
		if (! $jsonStructureDescriptor->isValidInput($input)) {
			// The input is invalid
			return false;
		}
		
		// Replaces the request's body with the decoded input
		$app->request->setBody($input);
		
		return true;
	}
	
}
