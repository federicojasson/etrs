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
 * Determines whether a certain value is present in an array.
 * 
 * It receives the value and the array.
 */
function isValueInArray($value, $array) {
	return in_array($value, $array, true);
}
