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
 * Returns the current date-time.
 */
function getCurrentDateTime() {
	// Initializes the time zone (UTC for consistency)
	$timeZone = new \DateTimeZone('UTC');
	
	// Initializes the current date-time
	return new \DateTime(null, $timeZone);
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
 * Converts a string from spinal-case to PascalCase.
 * 
 * Receives the string.
 */
function spinalToPascalCase($string) {
	// Replaces the dashes with spaces
	$string = str_replace('-', ' ', $string);
	
	// Converts the first character of each word to uppercase
	$string = ucwords($string);
	
	// Removes the spaces
	return str_replace(' ', '', $string);
}
