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
 * This class offers server-related functionalities.
 */
class Server {
	
	/**
	 * Returns the IP address of the client.
	 */
	public function getClientIpAddress() {
		// Gets the IP address
		$ipAddress = $_SERVER['REMOTE_ADDR'];

		// Converts the IP address to binary
		$binaryIpAddress = inet_pton($ipAddress);
		
		if ($binaryIpAddress === false) {
			// The IP address is invalid
			return 'unknown';
		}

		// Defines the IPv4-mapped IPv6 address prefix and gets its length
		$prefix = hex2bin('00000000000000000000ffff');
		$length = strlen($prefix);
		
		if ($prefix === substr($binaryIpAddress, 0, $length)) {
			// The IP address is an IPv4-mapped IPv6 address
			// Removes the prefix
			$binaryIpAddress = substr($binaryIpAddress, strlen($prefix));
		}

		// Converts the IP address back to its human-readable format
		$canonicalIpAddress = inet_ntop($binaryIpAddress);

		return $canonicalIpAddress;
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
	 * TODO: comment
	 */
	public function haltExecution($httpStatus, $code) {
		global $app;
		
		// Halts the execution
		$app->halt($httpStatus, [
			'code' => $code
		]);
	}
	
}
