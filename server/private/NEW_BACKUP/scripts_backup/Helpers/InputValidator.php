<?php

namespace App\Helpers;

/*
 * This helper offers input validation functions.
 */
class InputValidator extends \App\Helpers\Helper {
	
	/*
	 * Determines whether an input is a bounded integer.
	 * 
	 * It receives the input and the maximum allowed value.
	 */
	public function isBoundedInteger($input, $maximumValue) {
		if (! is_int($input)) {
			// The input is not an integer
			return false;
		}
		
		// Checks whether the input's range is valid
		return $input <= $maximumValue;
	}
	
	/*
	 * Determines whether an input is a bounded string.
	 * 
	 * It receives the input and the maximum allowed length.
	 */
	public function isBoundedString($input, $maximumLength) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input's length is valid
		return getStringLength($input) <= $maximumLength;
	}
	
	/*
	 * Determines whether an input is a command line.
	 * 
	 * It receives the input.
	 */
	public function isCommandLine($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input matches a regular expression
		return preg_match('/^.*:input.*$/', $input); // TODO: check regular expression
	}
	
	/*
	 * Determines whether an input is a data type definition.
	 * 
	 * It receives the input.
	 */
	public function isDataTypeDefinition($input) {
		// TODO: implement
		return true;
	}
	
	/*
	 * Determines whether an input is a date.
	 * 
	 * It receives the input.
	 */
	public function isDate($input) {
		// TODO: implement
		return true;
	}
	
	/*
	 * Determines whether an input is an email address.
	 * 
	 * It receives the input.
	 */
	public function isEmailAddress($input) {
		// TODO: implement
		return true;
	}
	
	/*
	 * Determines whether an input is a gender.
	 * 
	 * It receives the input.
	 */
	public function isGender($input) {
		return $this->isPredefinedValue($input, [
			GENDER_FEMALE,
			GENDER_MALE
		]);
	}
	
	/*
	 * Determines whether an input is a non-empty string.
	 * 
	 * It receives the input.
	 */
	public function isNonEmptyString($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input's length is valid
		return getStringLength($input) > 0;
	}
	
	/*
	 * Determines whether an input is a non-negative integer.
	 * 
	 * It receives the input.
	 */
	public function isNonNegativeInteger($input) {
		if (! is_int($input)) {
			// The input is not an integer
			return false;
		}
		
		// Checks whether the input's range is valid
		return $input >= 0;
	}
	
	/*
	 * Determines whether an input is a password.
	 * 
	 * It receives the input.
	 */
	public function isPassword($input) {
		// TODO: implement
		return true;
	}
	
	/*
	 * Determines whether an input is a positive integer.
	 * 
	 * It receives the input.
	 */
	public function isPositiveInteger($input) {
		if (! is_int($input)) {
			// The input is not an integer
			return false;
		}
		
		// Checks whether the input's range is valid
		return $input > 0;
	}
	
	/*
	 * Determines whether an input matches any value of a predefined set.
	 * 
	 * It receives the input and the values.
	 */
	public function isPredefinedValue($input, $values) {
		foreach ($values as $value) {
			if ($input === $value) {
				// The input matches the value
				return true;
			}
		}
		
		// The input doesn't match any of the values
		return false;
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
		return $this->isPredefinedValue($input, [
			SORTING_ORDER_ASCENDING,
			SORTING_ORDER_DESCENDING
		]);
	}
	
	/*
	 * Determines whether an input is a user role.
	 * 
	 * It receives the input.
	 */
	public function isUserRole($input) {
		return $this->isPredefinedValue($input, [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		]);
	}
	
	/*
	 * Validates a JSON request and returns the result.
	 * 
	 * If the request is valid, the input is replaced by its decoded version.
	 * 
	 * It receives the descriptor of the expected JSON structure.
	 */
	public function validateJsonRequest($jsonStructureDescriptor) {
		$app = $this->app;
		
		// Gets the media type
		$mediaType = $app->request->getMediaType();
		
		if ($mediaType !== HTTP_MEDIA_TYPE_JSON) {
			// The media type is not JSON
			return false;
		}
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Decodes the input
		$decodedInput = json_decode($input, true);
		
		if (is_null($decodedInput)) {
			// The input could not be decoded
			return false;
		}
		
		if (! $jsonStructureDescriptor->validateJsonStructure($decodedInput)) {
			// The input didn't pass the validation
			return false;
		}
		
		// Replaces the input with its decoded version
		$app->request->setBody($decodedInput);
		
		return true;
	}
	
}
