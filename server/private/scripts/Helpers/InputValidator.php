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
	 * Determines whether an input is a type description.
	 * 
	 * It receives the input.
	 */
	public function isTypeDescription($input) {
		if (! $this->isNonEmptyString($input)) {
			// The input is not a string or is an empty one
			return false;
		}
		
		// TODO: comment and order
		$fields = explode(';', $input);
		
		$type = $fields[0];
		
		$definition = [];
		
		$count = count($fields);
		for ($i = 1; $i < $count; $i++) {
			$field = explode(':', $fields[$i]);
			
			if (count($field) !== 2) {
				return false;
			}
			
			$label = trimString($field[0]);
			
			if (isStringEmpty($label)) {
				return false;
			}
			
			if (array_key_exists($label, $definition)) {
				return false;
			}
			
			$definition[$label] = $field[1];
		}
		
		switch ($type) {
			case 'boolean': {
				return $this->isBooleanTypeDefinition($definition);
			}
			
			case 'integer_fix_values': {
				return $this->isIntegerFixValuesTypeDefinition($definition);
			}
			
			case 'integer_range': {
				return $this->isIntegerRangeTypeDefinition($definition);
			}
			
			default: {
				return false;
			}
		}
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
		
		if (! $jsonStructureDescriptor->validateJsonStructure($decodedInput)) {
			// The input didn't pass the validation
			return false;
		}
		
		// Replaces the input with its decoded version
		$app->request->setBody($decodedInput);
		
		return true;
	}
	
	/*
	 * TODO: comments
	 * 
	 * It receives the definition.
	 */
	private function isBooleanTypeDefinition($definition) {
		// TODO: comment and order
		
		if (count($definition) !== 2) {
			return false;
		}
		
		if (! isValueInArray('false', $definition)) {
			return false;
		}
		
		if (! isValueInArray('true', $definition)) {
			return false;
		}
		
		return true;
	}
	
	/*
	 * TODO: comments
	 * 
	 * It receives the definition.
	 */
	private function isIntegerFixValuesTypeDefinition($definition) {
		// TODO: comment and order
		
		if (count($definition) === 0) {
			return false;
		}
		
		foreach ($definition as $value) {
			if (! isStringInteger($value)) {
				return false;
			}
		}
		
		if (arrayContainsDuplicateValues($definition)) {
			return false;
		}
		
		return true;
	}
	
	/*
	 * TODO: comments
	 * 
	 * It receives the definition.
	 */
	private function isIntegerRangeTypeDefinition($definition) {
		// TODO: comments and order
		
		if (count($definition) !== 2) {
			return false;
		}
		
		if (! array_key_exists('min', $definition)) {
			return false;
		}
		
		if (! array_key_exists('max', $definition)) {
			return false;
		}
		
		if (! isStringInteger($definition['min'])) {
			return false;
		}
		
		$minimum = (int) $definition['min'];
		
		if (! isStringInteger($definition['max'])) {
			return false;
		}
		
		$maximum = (int) $definition['max'];
		
		if ($maximum < $minimum) {
			return false;
		}
		
		return true;
	}
	
}
