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
 * This class offers cryptography-related functionalities.
 */
class Cryptography {
	
	/**
	 * Generates a random ID.
	 */
	public function generateRandomId() {
		return $this->generateRandomBytesSequence(LENGTH_RANDOM_ID);
	}
	
	/**
	 * Generates a random password.
	 */
	public function generateRandomPassword() {
		return $this->generateRandomBytesSequence(LENGTH_RANDOM_PASSWORD);
	}
	
	/**
	 * Computes the hash of a new password. Returns an array containing the
	 * computed hash, the salt used and the number of iterations that were
	 * applied in the key stretching.
	 * 
	 * The method should be used to compute a password hash for the first time.
	 * 
	 * Receives the password.
	 */
	public function hashNewPassword($password) {
		// Generates a salt
		$salt = $this->generateRandomBytesSequence(LENGTH_SALT);
		
		// Defines the number of iterations to be applied in the key stretching
		$keyStretchingIterations = KEY_STRETCHING_ITERATIONS;
		
		// Computes the hash of the password
		$passwordHash = $this->hashPassword($password, $salt, $keyStretchingIterations);
		
		return [ $passwordHash, $salt, $keyStretchingIterations ];
	}
	
	/**
	 * Computes the hash of a password.
	 * 
	 * The method should be used to compute a password hash to compare it with
	 * one previously obtained.
	 * 
	 * Receives the password, the salt and the number of iterations to be
	 * applied in the key stretching.
	 */
	public function hashPassword($password, $salt, $keyStretchingIterations) {
		// Applies SHA-512 and the PBKDF2 key derivation function
		return hash_pbkdf2('sha512', $password, $salt, $keyStretchingIterations, 0, true);
	}
	
	/**
	 * Generates a sequence of random bytes.
	 * 
	 * Receives the length of the sequence.
	 */
	private function generateRandomBytesSequence($length) {
		global $app;
		
		// Generates the sequence
		$cryptographicallyStrong = false;
		$sequence = openssl_random_pseudo_bytes($length, $cryptographicallyStrong);
		
		if (! $cryptographicallyStrong) {
			// The algorithm used is cryptographically weak
			// Logs the event
			$app->log->warning('Random bytes generated with a cryptographically weak algorithm.');
		}
		
		return $sequence;
	}
	
}
