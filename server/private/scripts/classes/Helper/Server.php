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

namespace App\Helper;

/**
 * Provides server-related functionalities.
 */
class Server {
	
	/**
	 * Returns the IP address of the client.
	 */
	public function getClientIpAddress() {
		// Gets the IP address
		$ipAddress = $_SERVER['REMOTE_ADDR'];

		// Converts the IP address to binary
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
			$ipAddress = substr($ipAddress, strlen($prefix));
		}

		// Converts the IP address back to a human-readable format
		$ipAddress = inet_ntop($ipAddress);

		return $ipAddress;
	}
	
	/**
	 * Returns the current date-time.
	 */
	public function getCurrentDateTime() {
		// Initializes the time zone
		$timeZone = new \DateTimeZone('UTC');
		
		// Returns the current date-time
		return new \DateTime(null, $timeZone);
	}
	
	/**
	 * Halts the execution of the application and responds to the client with an
	 * error.
	 * 
	 * Receives the HTTP status to be set and a code that indicates the reason
	 * of the error.
	 */
	public function haltExecution($httpStatus, $code) {
		global $app;
		
		// Halts the execution
		$app->halt($httpStatus, [
			'code' => $code
		]);
	}
	
}
