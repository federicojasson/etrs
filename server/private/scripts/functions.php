<?php

/*
 * This script defines global functions.
 */

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
