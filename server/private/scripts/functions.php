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
 * TODO: comments
 */
function getSearchExpressionFromQuery($query) {
	// Sanitizes the query
	$query = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $query);
	$query = preg_replace('/[^ 0-9A-Za-z]/', '', $query);
	$query = preg_replace('/[ ]+/', ' ', $query);
	$query = trim($query);

	if (getStringLength($query) === 0) {
		// The sanitized query is empty
		return '';
	}

	// Gets the words of the query
	$queryWords = explode(' ', $query);

	// Computes the words of the search expression
	$searchExpressionWords = [];
	$count = count($queryWords);
	for ($i = 0; $i < $count; $i++) {
		// Adds a wildcard to the end of the query's word
		$searchExpressionWords[$i] = $queryWords[$i] . '*';
	}

	// Builds the search expression concatenating its words
	$searchExpression = implode(' ', $searchExpressionWords);

	return $searchExpression;
}

/*
 * TODO: comments
 */
function getStringLength($string) {
	return mb_strlen($string, 'UTF-8');
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
