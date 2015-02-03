<?php

namespace App\Helper;

/*
 * This helper offers cryptography-related functionalities.
 */
class Cryptography extends Helper {
	
	/*
	 * Generates and returns a random ID.
	 */
	public function generateRandomId() {
		return $this->generateRandomBytesSequence(RANDOM_ID_LENGTH);
	}
	
	/*
	 * Computes and returns the hash of a password.
	 * 
	 * It receives the password, the salt and the iterations to apply in the key
	 * derivation.
	 */
	public function hashPassword($password, $salt, $keyDerivationIterations) {
		// Applies SHA-512 and the PBKDF2 key derivation function
		return hash_pbkdf2('sha512', $password, $salt, $keyDerivationIterations, 0, true);
	}
	
	/*
	 * Generates and returns a sequence of random bytes.
	 * 
	 * It receives the length of the sequence.
	 */
	private function generateRandomBytesSequence($length) {
		$app = $this->app;
		
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
