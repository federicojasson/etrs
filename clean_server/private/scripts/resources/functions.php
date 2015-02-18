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
 * This script defines useful global functions.
 */

/**
 * Converts a string from camelCase or PascalCase to spinal-case.
 * 
 * Receives the string.
 */
function toSpinalCase($string) {
	// Performs a regular expression search
	$matches = [];
	preg_match_all('/[A-Za-z][0-9a-z]+|[A-Z][0-9A-Z]*(?=$|[A-Z][0-9a-z])/', $string, $matches);
	
	// Gets the individual words found
	$words = $matches[0];
	
	// Processes the words
	foreach ($words as &$word) {
		if ($word === strtoupper($word)) {
			// The word is completely in uppercase
			// Converts the word to lowercase
			$word = strtolower($word);
		} else {
			// The word is not completely in uppercase
			// Converts the first character of the word to lowercase
			$word = lcfirst($word);
		}
	}
	
	// Builds and returns the new string
	return implode('-', $words);
}
