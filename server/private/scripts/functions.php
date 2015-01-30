<?php

/*
 * This script defines global functions.
 */

/*
 * Returns the first element of an array. If the array is empty, null is
 * returned.
 * 
 * It receives the array.
 */
function getFirstElementOrNull($array) {
	if (count($array) === 0) {
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
	return mb_strlen($string, CHARACTER_ENCODING_UTF8);
}

/*
 * Determines whether an array is sequential.
 * 
 * It receives the array.
 */
function isSequentialArray($array) {
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
 * It receives the file's path and a mapping containing placeholders as its keys
 * and replacements as its values.
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
 * It receives the string and a mapping containing placeholders as its keys and
 * replacements as its values.
 */
function replacePlaceholders($string, $mapping) {
	// Gets the placeholders and the replacements in different arrays
	$placeholders = array_keys($mapping);
	$replacements = array_values($mapping);

	// Replaces the placeholders and returns the result
	return str_replace($placeholders, $replacements, $string);
}

/*
 * Trims a string, removing duplicate, leading and trailing whitespaces.
 * 
 * It receives the string.
 */
function trimString($string) {
	// Removes duplicate whitespaces
	$string = preg_replace('/[ ]+/', ' ', $string);
	
	// Removes leading and trailing whitespaces
	$string = trim($string, ' ');
	
	return $string;
}
