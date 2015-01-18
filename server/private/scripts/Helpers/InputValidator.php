<?php

namespace App\Helpers;

/*
 * This helper offers input validation functions.
 */
class InputValidator extends \App\Helpers\Helper {
	
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
