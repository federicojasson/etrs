<?php

namespace App\Helpers;

/*
 * This helper offers input validation functions.
 */
class InputValidator extends \App\Helpers\Helper {
	
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
	 * Determines whether an input is a data type descriptor.
	 * 
	 * It receives the input.
	 */
	public function isDataTypeDescriptor($input) {
		if (! $this->isBoundedString($input, 1024)) {
			// The input is not a string or is not bounded properly
			return false;
		}
		
		try {
			// Tries to initialize a data type descriptor
			new \App\Auxiliars\DataTypeDescriptor($input);
			
			// The operation succeeded
			return true;
		} catch (Exception $exception) {
			// The operation failed
			return false;
		}
	}
	
	/*
	 * Determines whether an input is an email address.
	 * 
	 * It receives the input.
	 */
	public function isEmailAddress($input) {
		if (! $this->isBoundedString($input, 254)) {
			// The input is not a string or is not bounded properly
			return false;
		}
		
		// Checks whether the input matches a regular expression
		return preg_match('/(?!.*[ ])(?!.*@.*@)^.+@.+$/', $input);
	}
	
	/*
	 * Determines whether an input is a gender.
	 * 
	 * It receives the input.
	 */
	public function isGender($input) {
		return isValueInArray($input, [
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
		return isValueInArray($input, [
			SORTING_ORDER_ASCENDING,
			SORTING_ORDER_DESCENDING
		]);
	}
	
	/*
	 * Determines whether an input is a valid password.
	 * 
	 * It receives the input.
	 */
	public function isValidPassword($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}

		if (getStringLength($input) < 8) {
			// The input is too short
			return false;
		}

		if (! preg_match('/[0-9]/', $input)) {
			// The input is too short
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
		
		if (! $jsonStructureDescriptor->isValidJsonStructure($decodedInput)) {
			// The input is invalid
			return false;
		}
		
		// Replaces the input with its decoded version
		$app->request->setBody($decodedInput);
		
		return true;
	}
	
}
