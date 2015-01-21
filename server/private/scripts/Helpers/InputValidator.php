<?php

namespace App\Helpers;

/*
 * This helper offers input validation functions.
 */
class InputValidator extends \App\Helpers\Helper {
	
	/*
	 * Determines whether an input is a string and matches any of a certain set.
	 * 
	 * It receives the input and the strings.
	 */
	public function isCertainString($input, $strings) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input matches any of the strings
		$count = count($strings);
		for ($i = 0; $i < $count; $i++) {
			if ($input === $strings[$i]) {
				// The input matches the string
				return true;
			}
		}
		
		// The input doesn't match any of the strings
		return false;
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
