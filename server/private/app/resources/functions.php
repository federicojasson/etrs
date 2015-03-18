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
 * Returns the current date-time.
 */
function getCurrentDateTime() {
	// Initializes the time zone (UTC for consistency)
	$timeZone = new \DateTimeZone('UTC');
	
	// Initializes the current date-time
	return new \DateTime(null, $timeZone);
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
	
	// Compares the array's keys with the indices
	return array_keys($array) === $indices;
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
