<?php

/*
 * This script defines global functions.
 */

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
 * Reads the content of a JSON file, decodes it and returns the result.
 * 
 * It receives the file's path.
 */
function readJsonFile($filePath) {
	// Gets the file's content
	$fileContent = file_get_contents($filePath);

	// Decodes the content and returns the result
	return json_decode($fileContent, true);
}
