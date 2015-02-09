<?php

/*
 * This script defines global functions.
 */

/*
 * Applies a function to all the elements of an array and returns the result.
 * 
 * It receives the array and the function to apply.
 */
function applyFunctionToArray($array, $function) {
	// Applies the function to all the elements of the array
	foreach ($array as &$element) {
		$element = call_user_func($function, $element);
	}
	
	return $array;
}

/*
 * Determines whether an array contains duplicate elements.
 * 
 * It receives the array.
 */
function arrayContainsDuplicateElements($array) {
	// Removes duplicate elements from the array
	$arrayWithoutDuplicates = array_unique($array);
	
	// Compares the number of elements on the arrays and returns the result
	return count($arrayWithoutDuplicates) !== count($array);
}

/*
 * Converts the IDs of a set of arrays from hexadecimal to binary. It assumes
 * that these contain the key 'id'.
 * 
 * It receives the arrays.
 */
function arrayIdsToBinary($arrays) {
	// Converts the IDs from hexadecimal to binary
	foreach ($arrays as &$array) {
		$array['id'] = hex2bin($array['id']);
	}

	return $arrays;
}

/*
 * Converts the IDs of a set of arrays from binary to hexadecimal. It assumes
 * that these contain the key 'id'.
 * 
 * It receives the arrays.
 */
function arrayIdsToHexadecimal($arrays) {
	// Converts the IDs from binary to hexadecimal
	foreach ($arrays as &$array) {
		$array['id'] = bin2hex($array['id']);
	}

	return $arrays;
}

/*
 * Converts a string from camel case notation to snake case notation.
 * 
 * It receives the string.
 */
function camelCaseToSnakeCase($string) {
	// Performs a regular expression search
	$matches = [];
	preg_match_all('/[A-Za-z][0-9a-z]+|[A-Z][0-9A-Z]*(?=$|[A-Z][0-9a-z])/', $string, $matches);
	$words = $matches[0];
	
	// Processes the words
	foreach ($words as &$word) {
		if ($word === strtoupper($word)) {
			// The word is in uppercase
			
			// Converts the word to lowercase
			$word = strtolower($word);
		} else {
			// The word is in lowercase
			
			// Converts the first character of the word to lowercase
			$word = lcfirst($word);
		}
	}
	
	// Builds and returns the new string
	return implode('_', $words);
}

/*
 * Filters the entries of an array, leaving only those whose keys belong to a
 * certain set.
 * 
 * It receives the array and the keys.
 */
function filterArray($array, $keys) {
	// Initializes the new array
	$newArray = [];
	
	// Filters the entries
	foreach ($keys as $key) {
		if (array_key_exists($key, $array)) {
			// The key is defined in the array
			$newArray[$key] = $array[$key];
		}
	}
	
	return $newArray;
}

/*
 * Returns the first element of an array. If the array is empty, null is
 * returned.
 * 
 * It receives the array.
 */
function getFirstElementOrNull($array) {
	if (isArrayEmpty($array)) {
		// The array is empty
		return null;
	}

	// Returns the first element
	return $array[0];
}

/*
 * Returns the length of a string.
 * 
 * It receives the string.
 */
function getStringLength($string) {
	return mb_strlen($string, 'UTF-8');
}

/*
 * Determines whether an array is empty.
 * 
 * It receives the array.
 */
function isArrayEmpty($array) {
	return count($array) === 0;
}

/*
 * Determines whether a certain element is present in an array.
 * 
 * It receives the element and the array.
 */
function isElementInArray($element, $array) {
	return in_array($element, $array, true);
}

/*
 * Determines whether an array is sequential.
 * 
 * It receives the array.
 */
function isSequentialArray($array) {
	if (isArrayEmpty($array)) {
		// The array is empty
		return true;
	}
	
	// Initializes an array with the sequential indices
	$indices = range(0, count($array) - 1);

	// Compares the keys of the array with the indices and returns the result
	return array_keys($array) === $indices;
}

/*
 * Determines whether a string is empty.
 * 
 * It receives the string.
 */
function isStringEmpty($string) {
	return getStringLength($string) === 0;
}

/*
 * Determines whether a string represents an integer.
 * 
 * It receives the string.
 */
function isStringInteger($string) {
	return (string) (int) $string === $string;
}

/*
 * Reads the content of a JSON file, decodes it and returns the result.
 * 
 * It receives the file's path.
 */
function readJsonFile($path) {
	// Gets the file's content
	$content = file_get_contents($path);
	
	// Decodes the content and returns the result
	return json_decode($content, true);
}

/*
 * Reads the content of a template file, replaces its placeholders and returns
 * the result.
 * 
 * It receives the file's path and a mapping containing placeholders as keys and
 * replacements as values.
 */
function readTemplateFile($path, $mapping) {
	// Gets the file's content
	$content = file_get_contents($path);
	
	// Replaces the placeholders and returns the result
	return replacePlaceholders($content, $mapping);
}

/*
 * Given a string with placeholders, it replaces them with specific strings and
 * returns the result.
 * 
 * It receives the string and a mapping containing placeholders as keys and
 * replacements as values.
 */
function replacePlaceholders($string, $mapping) {
	// Gets the placeholders and the replacements in different arrays
	$placeholders = array_keys($mapping);
	$replacements = array_values($mapping);

	// Replaces the placeholders and returns the result
	return str_replace($placeholders, $replacements, $string);
}

/*
 * Converts a string from snake case notation to camel case notation.
 * 
 * It receives the string.
 */
function snakeCaseToCamelCase($string) {
	// Replaces the underscores with whitespaces
	$string = str_replace('_', ' ', $string);
	
	// Converts the first character of each word to uppercase
	$string = ucwords($string);
	
	// Removes the whitespaces
	$string = str_replace(' ', '', $string);
	
	// Converts the first character to lowercase and returns the result
	return lcfirst($string);
}

/*
 * Converts a string to boolean.
 * 
 * It receives the string.
 */
function stringToBoolean($string) {
	return ($string === 'false')? false : true;
}

/*
 * Converts a string to integer.
 * 
 * It receives the string.
 */
function stringToInteger($string) {
	return (int) $string;
}

/*
 * Converts a set of strings from hexadecimal to binary.
 * 
 * It receives the strings.
 */
function stringsToBinary($strings) {
	return applyFunctionToArray($strings, 'hex2bin');
}

/*
 * Trims a string, removing duplicate, leading and trailing whitespaces.
 * 
 * It receives the string.
 */
function trimString($string) {
	// Removes duplicate whitespaces
	$string = preg_replace('/[ ]+/', ' ', $string);
	
	// Removes leading and trailing whitespaces and returns the result
	return trim($string, ' ');
}
