<?php

/*
 * This script defines global functions.
 */

/*
 * TODO: comments
 */
function binaryToHexadecimal($binary) {
	if (is_null($binary)) {
		// The parameter received is null
		return null;
	}
	
	// Converts from binary to hexadecimal and returns the result
	return bin2hex($binary);
}

/*
 * Returns the first element of an array, or null if the array is empty.
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
 * TODO: comments
 */
function hexadecimalToBinary($hexadecimal) {
	if (is_null($hexadecimal)) {
		// The parameter received is null
		return null;
	}
	
	// Converts from hexadecimal to binary and returns the result
	return hex2bin($hexadecimal);
}

/*
 * Determines whether an array is sequential.
 * 
 * It receives the array.
 */
function isSequentialArray($array) {
	// Initializes an array with the sequential indices
	$indexArray = range(0, count($array) - 1);

	// Compares the keys of the array with the index array
	return array_keys($array) === $indexArray;
}

/*
 * Reads the content of a JSON file, decodes it and returns the result.
 * 
 * It receives the file path.
 */
function readJsonFile($filePath) {
	// Gets the file's content
	$fileContent = file_get_contents($filePath);

	// Decodes the file's content and returns the result
	return json_decode($fileContent, true);
}
