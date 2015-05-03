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
 * Builds a boolean expression from a string.
 * 
 * A boolean expression is a sanitized version of the string that contains
 * wildcard characters.
 * 
 * Receives the string.
 */
function buildBooleanExpression($string) {
	// Transliterates the string
	$string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
	
	// Replaces non-alphanumeric characters with spaces
	$string = preg_replace('/[^ 0-9A-Za-z]/', ' ', $string);
	
	// Trims and shrinks the string
	$string = trimAndShrink($string);
	
	if ($string === '') {
		// The string is empty
		return '';
	}
	
	// Gets the words of the string
	$words = explode(' ', $string);
	
	// Appends a wildcard character to the words
	$words = filterArray($words, function($word) {
		return $word . '*';
	});
	
	// Builds the boolean expression
	return implode(' ', $words);
}

/**
 * Builds a file name from a string.
 * 
 * A file name is a sanitized version of the string.
 * 
 * Receives the string.
 */
function buildFileName($string) {
	// Removes the control characters
	$string = preg_replace('/[\x{0000}-\x{001f}]/', '', $string);
	
	// Removes the forbidden characters
	$string = preg_replace('/["*\/:<>?\\\|]/', '', $string);
	
	// Trims the string
	$string = trim($string);
	
	if ($string === '') {
		// The string is empty
		return FILE_UNNAMED_NAME;
	}
	
	return $string;
}

/**
 * Builds a path.
 * 
 * Receives path's fragments.
 */
function buildPath() {
	// Gets the fragments
	$fragments = func_get_args();
	
	// Builds the path of each fragment
	$fragments = filterArray($fragments, function($fragment) {
		if (is_array($fragment)) {
			$fragment = call_user_func_array('buildPath', $fragment);
		}
		
		return $fragment;
	});
	
	// Builds the path
	return implode(DIRECTORY_SEPARATOR, $fragments);
}

/**
 * Builds a URL from a path.
 * 
 * Receives the path.
 */
function buildUrl($path) {
	// Replaces directory separators with slashes
	return str_replace(DIRECTORY_SEPARATOR, '/', $path);
}

/**
 * Calculates a search offset.
 * 
 * Receives the page and the results per page.
 */
function calculateSearchOffset($page, $resultsPerPage) {
	return $resultsPerPage * ($page - 1);
}

/**
 * Converts a string from camelCase to PascalCase.
 * 
 * Receives the string.
 */
function camelToPascalCase($string) {
	// Converts the first character to uppercase
	return ucfirst($string);
}

/**
 * Converts a string from camelCase to spinal-case.
 * 
 * Receives the string.
 */
function camelToSpinalCase($string) {
	// Performs a regular expression search
	$matches = [];
	preg_match_all('/[0-9]+|[A-Za-z][a-z]*/', $string, $matches);
	$terms = $matches[0];
	
	// Converts the first character of each term to lowercase
	$terms = filterArray($terms, 'lcfirst');
	
	// Builds the spinal-case string
	return implode('-', $terms);
}

/**
 * Determines whether an array contains duplicate elements.
 * 
 * Receives the array.
 */
function containsDuplicates($array) {
	// Removes the duplicate elements
	$arrayWithoutDuplicates = array_unique($array);
	
	// Compares the arrays' lengths
	return count($array) !== count($arrayWithoutDuplicates);
}

/**
 * Creates an array filter.
 * 
 * Receives a filter for the elements.
 */
function createArrayFilter($filter) {
	return function($array) use ($filter) {
		// Applies the filter
		return filterArray($array, $filter);
	};
}

/**
 * Applies a filter to an array's elements.
 * 
 * Receives the array and a filter for the elements.
 */
function filterArray($array, $filter) {
	return array_map($filter, $array);
}

/**
 * Filters a set of cognitive-test results.
 * 
 * Receives the cognitive-test results.
 */
function filterCognitiveTestResults($cognitiveTestResults) {
	return filterTestResults($cognitiveTestResults, 'CognitiveTest');
}

/**
 * Filters a set of imaging-test results.
 * 
 * Receives the imaging-test results.
 */
function filterImagingTestResults($imagingTestResults) {
	return filterTestResults($imagingTestResults, 'ImagingTest');
}

/**
 * Filters a set of laboratory-test results.
 * 
 * Receives the laboratory-test results.
 */
function filterLaboratoryTestResults($laboratoryTestResults) {
	return filterTestResults($laboratoryTestResults, 'LaboratoryTest');
}

/**
 * Filters a recipient.
 * 
 * Receives the recipient.
 */
function filterRecipient($recipient) {
	$recipient['fullName'] = trimAndShrink($recipient['fullName']);
	return $recipient;
}

/**
 * Filters a set of sorting criteria.
 * 
 * Receives the sorting criteria.
 */
function filterSortingCriteria($sortingCriteria) {
	$newSortingCriteria = [];

	// Adds the sorting criteria
	foreach ($sortingCriteria as $sortingCriterion) {
		$field = $sortingCriterion['field'];
		$direction = ($sortingCriterion['direction'] === SORTING_DIRECTION_ASCENDING)? 'ASC' : 'DESC';
		$newSortingCriteria[$field] = $direction;
	}

	return $newSortingCriteria;
}

/**
 * Filters a set of test results.
 * 
 * Receives the test results and the type of the test entity.
 */
function filterTestResults($testResults, $type) {
	$newTestResults = [];
	
	// Converts the type from PascalCase to camelCase
	$type = pascalToCamelCase($type);
	
	// Adds the test results
	foreach ($testResults as $testResult) {
		$test = hex2bin($testResult[$type]);
		$value = $testResult['value'];
		$newTestResults[$test] = $value;
	}
	
	return $newTestResults;
}

/**
 * Returns the client's IP address.
 */
function getClientIpAddress() {
	// Gets the IP address
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	
	// Converts the IP address to its in_addr representation
	$ipAddress = inet_pton($ipAddress);
	
	if ($ipAddress === false) {
		// The IP address is invalid
		return 'unknown';
	}
	
	// Defines the IPv4-mapped IPv6 address prefix and gets its length
	$prefix = hex2bin('00000000000000000000ffff');
	$length = strlen($prefix);
	
	if ($prefix === substr($ipAddress, 0, $length)) {
		// The IP address is an IPv4-mapped IPv6 address
		// Removes the prefix
		$ipAddress = substr($ipAddress, $length);
	}
	
	// Converts the IP address back to a human-readable format
	$ipAddress = inet_ntop($ipAddress);
	
	return $ipAddress;
}

/**
 * Determines whether a certain element is present in an array.
 * 
 * Receives the element and the array.
 */
function inArray($element, $array) {
	return in_array($element, $array, true);
}

/**
 * Determines whether a value is in a certain range.
 * 
 * Receives the value, the lower bound and, optionally, the upper.
 */
function inRange($value, $lowerBound, $upperBound = null) {
	// Initializes the upper bound if is null
	$upperBound = (! is_null($upperBound))? $upperBound : $value;
	
	// Determines whether the value is in the specified range
	return $value >= $lowerBound && $value <= $upperBound;
}

/**
 * Determines whether an array is sequential.
 * 
 * Receives the array.
 */
function isArraySequential($array) {
	// Gets the array's length
	$length = count($array);
	
	if ($length === 0) {
		// The array is empty
		return true;
	}
	
	// Initializes an array containing the sequential indices
	$indices = range(0, $length - 1);
	
	// Compares the indices with the array's keys
	return $indices === array_keys($array);
}

/**
 * Determines whether a string represents an integer.
 * 
 * Receives the string.
 */
function isStringAnInteger($string) {
	return (string) (int) $string === $string;
}

/**
 * Converts a string from PascalCase to camelCase.
 * 
 * Receives the string.
 */
function pascalToCamelCase($string) {
	// Converts the first character to lowercase
	return lcfirst($string);
}

/**
 * Reads the contents of a JSON file.
 * 
 * Receives the file's path.
 */
function readJsonFile($path) {
	// Reads the contents of the file
	$contents = file_get_contents($path);
	
	// Decodes the contents
	return json_decode($contents, true);
}

/**
 * Reads the contents of a template file and replaces its placeholders.
 * 
 * Receives the file's path and a mapping containing placeholders as keys and
 * replacements as values.
 */
function readTemplateFile($path, $mapping) {
	// Reads the contents of the file
	$contents = file_get_contents($path);
	
	// Replaces the placeholders
	return replacePlaceholders($contents, $mapping);
}

/**
 * Removes an array's element by index.
 * 
 * Receives the index and the array.
 */
function removeFromArrayByIndex($index, &$array) {
	array_splice($array, $index, 1);
}

/**
 * Given a string with placeholders, it replaces them with specific strings.
 * 
 * Receives the string and a mapping containing placeholders as keys and
 * replacements as values.
 */
function replacePlaceholders($string, $mapping) {
	// Gets the placeholders and the replacements in different arrays
	$placeholders = array_keys($mapping);
	$replacements = array_values($mapping);
	
	// Prepends a colon to the placeholders
	$placeholders = filterArray($placeholders, function($placeholder) {
		return ':' . $placeholder;
	});

	// Replaces the placeholders
	return str_replace($placeholders, $replacements, $string);
}

/**
 * Searches an array's element.
 * 
 * Receives the element and the array.
 */
function searchInArray($element, $array) {
	return array_search($element, $array, true);
}

/**
 * Converts a string from snake_case to PascalCase.
 * 
 * Receives the string.
 */
function snakeToPascalCase($string) {
	// Replaces underscores with spaces
	$string = str_replace('_', ' ', $string);
	
	// Converts the first character of each word to uppercase
	$string = ucwords($string);
	
	// Removes the spaces
	return str_replace(' ', '', $string);
}

/**
 * Converts a string from spinal-case to PascalCase.
 * 
 * Receives the string.
 */
function spinalToPascalCase($string) {
	// Replaces dashes with spaces
	$string = str_replace('-', ' ', $string);
	
	// Converts the first character of each word to uppercase
	$string = ucwords($string);
	
	// Removes the spaces
	return str_replace(' ', '', $string);
}

/**
 * Converts a string to boolean.
 * 
 * Receives the string.
 */
function stringToBoolean($string) {
	return $string === 'true';
}

/**
 * Converts a string to date.
 * 
 * Receives the string.
 */
function stringToDate($string) {
	return \DateTime::createFromFormat('Y-m-d', $string);
}

/**
 * Converts a variable to integer.
 * 
 * Receives the variable.
 */
function toInteger($variable) {
	return (int) $variable;
}

/**
 * Converts a variable to string.
 * 
 * Receives the variable.
 */
function toString($variable) {
	return (string) $variable;
}

/**
 * Trims and shrinks a string.
 * 
 * Receives the string.
 */
function trimAndShrink($string) {
	// Trims the string
	$string = trim($string);
	
	// Shrinks the string
	return preg_replace('/ +/', ' ', $string);
}
