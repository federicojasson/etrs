<?php

/*
 * TODO: comments
 */
class InputValidator extends Helper {
	
	/*
	 * Validates a JSON request and returns the result.
	 * 
	 * If the request is valid, the input is replaced by its decoded version.
	 * 
	 * It receives the request and the descriptor of the expected JSON
	 * structure.
	 */
	public function validateJsonRequest($request, $jsonStructureDescriptor) {
		// Gets the content type
		$contentType = $request->headers->get(HTTP_HEADER_CONTENT_TYPE);
		
		if ($contentType !== HTTP_CONTENT_TYPE_JSON) {
			// The content type is not JSON
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
