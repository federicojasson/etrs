<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * This script defines global functions.
 */

/**
 * TODO: comment
 * 
 * Receives the date-time.
 */
function dateTimeToString($dateTime) {
	return $dateTime->format('Y-m-d H:i:s');
}

/**
 * Filters the value of an array.
 * 
 * Receives a reference to the array, the key associated with the value and a
 * filter.
 */
function filterArrayValue(&$array, $key, $filter) {
	if (! isset($array[$key])) {
		// The key is not defined in the array
		return;
	}
	
	// Filters the value
	$array[$key] = call_user_func($filter, $array[$key]);
}

/**
 * Determines whether a certain value is present in an array.
 * 
 * Receives the array and the value.
 */
function inArray($array, $value) {
	return in_array($value, $array, true);
}

/**
 * Determines whether an array is sequential.
 * 
 * Receives the array.
 */
function isArraySequential($array) {
	// Gets the length of the array
	$length = count($array);
	
	if ($length === 0) {
		// The array is empty
		return true;
	}
	
	// Initializes an array with the sequential indices
	$indices = range(0, $length - 1);
	
	// Compares the keys of the array with the indices
	return array_keys($array) === $indices;
}

/**
 * Reads and decodes the content of a JSON file.
 * 
 * Receives the file's path.
 */
function readJsonFile($path) {
	// Gets the content of the file
	$content = file_get_contents($path);
	
	// Decodes the content
	return json_decode($content, true);
}

/**
 * Converts a string from spinal-case to PascalCase.
 * 
 * Receives the string.
 */
function toPascalCase($string) {
	// Replaces the dashes with whitespaces
	$string = str_replace('-', ' ', $string);
	
	// Converts the first character of each word to uppercase
	$string = ucwords($string);
	
	// Removes the whitespaces
	return str_replace(' ', '', $string);
}

/**
 * Trims a string and removes duplicate whitespaces.
 * 
 * Receives the string.
 */
function trimAndShrink($string) {
	// Removes duplicate whitespaces
	$string = preg_replace('/[ ]+/', ' ', $string);
	
	// Trims the string
	return trim($string, ' ');
}
