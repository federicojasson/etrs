<?php

/*
 * This helper offers input validation functions.
 */
class InputValidator extends Helper {
	
	/*
	 * Determines whether an input is a non empty string.
	 * 
	 * It receives the input.
	 */
	public function isNonEmptyString($input) {
		return strlen($input) > 0;
	}
	
	/*
	 * Determines whether an input is a valid user ID.
	 * 
	 * It receives the input.
	 */
	public function isValidUserId($input) {
		return preg_match('/^(?!.*[.]{2})(?![.])(?!.*[.]$)[.0-9A-Za-z]{1,32}$/', $input);
	}
	
	/*
	 * Determines whether an input is a valid UUID v4.
	 * 
	 * It receives the input.
	 */
	public function isValidUuidV4($input) {
		return preg_match('/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-4[0-9A-Fa-f]{3}-[89ABab][0-9A-Fa-f]{3}-[0-9A-Fa-f]{12}$/', $input);
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