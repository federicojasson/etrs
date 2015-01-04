<?php

/*
 * This helper offers input validation functions.
 */
class InputValidator extends Helper {
	
	/*
	 * TODO: comments
	 */
	public function isValidQuery($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Gets the input's length
		$length = getStringLength($input);
		
		// Checks whether the input's length is appropriate
		return $length > 0 && $length <= 256;
	}
	
	/*
	 * Determines whether an input is a valid random ID.
	 * 
	 * It receives the input.
	 */
	public function isValidRandomId($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input matches a regular expression
		return preg_match('/^[0-9A-Fa-f]{' . 2 * RANDOM_ID_LENGTH . '}$/', $input);
	}
	
	/*
	 * Determines whether an input is a valid required input.
	 * 
	 * It receives the input.
	 */
	public function isValidRequiredInput($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input's length is appropriate
		return getStringLength($input) > 0;
	}
	
	/*
	 * Determines whether an input is a valid user ID.
	 * 
	 * It receives the input.
	 */
	public function isValidUserId($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Checks whether the input matches a regular expression
		return preg_match('/^(?!.*[.]{2})(?![.])(?!.*[.]$)[.0-9A-Za-z]{1,32}$/', $input);
	}
	
	/*
	 * Validates a JSON request and returns the result.
	 * 
	 * If the request is valid, the input is replaced by its decoded version.
	 * 
	 * It receives the request and the descriptor of the expected JSON
	 * structure.
	 */
	public function validateJsonRequest($request, $jsonStructureDescriptor) {
		// Gets the media type
		$mediaType = $request->getMediaType();
		
		if ($mediaType !== HTTP_MEDIA_TYPE_JSON) {
			// The media type is not JSON
			return false;
		}
		
		// Gets the input
		$input = $request->getBody();
		
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
		$request->setBody($decodedInput);
		
		return true;
	}
	
}
