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
 * Provides cryptography-related functionalities.
 */
class Cryptography {
	
	
	/**
	 * Computes a file's hash.
	 * 
	 * Receives the file's path.
	 */
	public function computeFileHash($path) {
		// Gets the time limit
		$timeLimit = ini_get('max_execution_time');
		
		// Removes the time limit
		set_time_limit(0);
		
		// Computes the file's hash, using the MD5 function
		$hash = md5_file($path, true);
		
		// Restores the time limit
		set_time_limit($timeLimit);
		
		return $hash;
	}
	
	/**
	 * Computes a password's hash. It returns an array containing the hash, the
	 * used salt and the applied key-stretching iterations.
	 * 
	 * It should be used to compute a hash for the first time.
	 * 
	 * Receives the password.
	 */
	public function computeNewPasswordHash($password) {
		// Generates a salt
		$salt = $this->generateRandomBytes(SALT_LENGTH);
		
		// Defines the key-stretching iterations
		$keyStretchingIterations = KEY_STRETCHING_ITERATIONS;
		
		// Computes the password's hash
		$hash = $this->computePasswordHash($password, $salt, $keyStretchingIterations);
		
		return [ $hash, $salt, $keyStretchingIterations ];
	}
	
	/**
	 * Computes a password's hash.
	 * 
	 * It should be used to compute a hash and then compare it with another one
	 * previously obtained.
	 * 
	 * Receives the password, the salt and the key-stretching iterations.
	 */
	public function computePasswordHash($password, $salt, $keyStretchingIterations) {
		// Computes the password's hash, using the SHA-512 and PBKDF2 functions
		return hash_pbkdf2('sha512', $password, $salt, $keyStretchingIterations, 0, true);
	}
	
	/**
	 * Generates a random ID.
	 */
	public function generateRandomId() {
		return $this->generateRandomBytes(RANDOM_ID_LENGTH);
	}
	
	/**
	 * Generates a random password.
	 */
	public function generateRandomPassword() {
		return $this->generateRandomBytes(RANDOM_PASSWORD_LENGTH);
	}
	
	/**
	 * Generates random bytes.
	 * 
	 * Receives the expected length of the generated sequence (in bytes).
	 */
	private function generateRandomBytes($length) {
		global $app;
		
		// Generates the random bytes
		$cryptographicallyStrong = false;
		$bytes = openssl_random_pseudo_bytes($length, $cryptographicallyStrong);
		
		if (! $cryptographicallyStrong) {
			// The algorithm used is cryptographically weak
			// Logs the event
			$app->log->warning('Random bytes generated with a cryptographically weak algorithm.');
		}
		
		return $bytes;
	}
	
}
