<?php

namespace App\Helper;

/*
 * This helper offers input validation functions.
 */
class InputValidator extends Helper {
	
	/*
	 * Determines whether an input is a command line.
	 * 
	 * It receives the input.
	 */
	public function isCommandLine($input) {
		// TODO: implement
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
			// The input doesn't have a date format
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
	 * Determines whether an input is an email address.
	 * 
	 * It receives the input.
	 */
	public function isEmailAddress($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input has an email address format
		return preg_match('/(?!.*[ ])(?!.*@.*@)(?=.{3,254}$)^.+@.+$/', $input);
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
		
		// Checks whether the input has a random ID format
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
	 * Determines whether an input is a user ID.
	 * 
	 * It receives the input.
	 */
	public function isUserId($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input has a user ID format
		return preg_match('/^(?!.*[.]{2})(?![.])(?!.*[.]$)[.0-9A-Za-z]{3,32}$/', $input);
	}
	
	/*
	 * Determines whether an input is a user role.
	 * 
	 * It receives the input.
	 */
	public function isUserRole($input) {
		return isElementInArray($input, [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		]);
	}
	
	/*
	 * Determines whether an input is a valid integer.
	 * 
	 * It receives the input, the minimum allowed value and, optionally, the
	 * maximum allowed value.
	 */
	public function isValidInteger($input, $minimumValue, $maximumValue = PHP_INT_MAX) {
		if (! is_int($input)) {
			// The input is not an integer
			return false;
		}
		
		// Checks whether the input's value is in range
		return	$input >= $minimumValue &&
				$input <= $maximumValue;
	}
	
	/*
	 * Determines whether an input is a valid password.
	 * 
	 * It receives the input.
	 */
	public function isValidPassword($input) {
		if (! $this->isValidString($input, 8)) {
			// The input is not a valid string
			return false;
		}

		if (! preg_match('/[0-9]/', $input)) {
			// The input doesn't contain a digit
			return false;
		}
		
		if (! preg_match('/[A-Z]/', $input)) {
			// The input doesn't contain an uppercase character
			return false;
		}

		if (! preg_match('/[a-z]/', $input)) {
			// The input doesn't contain a lowercase character
			return false;
		}

		return true;
	}
	
	/*
	 * Determines whether an input is a valid string.
	 * 
	 * It receives the input, the minimum allowed length and, optionally, the
	 * maximum allowed length.
	 */
	public function isValidString($input, $minimumLength, $maximumLength = PHP_INT_MAX) {
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
		
		// Checks whether the input is a valid string
		return $this->isValidString($input, $minimumLength, $maximumLength);
	}
	
}
