<?php

namespace App\Helper;

/*
 * This helper offers input validation functions.
 */
class InputValidator extends Helper {
	// TODO: implement methods
	
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
		// TODO: implement
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
		
		// Checks whether the input's value is in range
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
