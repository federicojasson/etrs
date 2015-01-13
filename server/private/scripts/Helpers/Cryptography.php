<?php

namespace App\Helpers;

/*
 * This helper offers cryptography-related functionalities.
 */
class Cryptography extends \App\Helpers\Helper {
	
	/*
	 * Generates and returns a random ID.
	 */
	public function generateRandomId() {
		return $this->generateRandomBytesSequence(RANDOM_ID_LENGTH);
	}
	
	/*
	 * Generates and returns a random password.
	 */
	public function generateRandomPassword() {
		return $this->generateRandomBytesSequence(RANDOM_PASSWORD_LENGTH);
	}
	
	/*
	 * Generates and returns a salt.
	 */
	public function generateSalt() {
		return $this->generateRandomBytesSequence(SALT_LENGTH);
	}
	
	// TODO: Helpers/Cryptography.php
	
	/*
	 * Generates and returns a sequence of random bytes.
	 * 
	 * It receives the length of the sequence.
	 */
	private function generateRandomBytesSequence($length) {
		$cryptographicallyStrong = false;
		
		// Generates the sequence
		$sequence = openssl_random_pseudo_bytes($length, $cryptographicallyStrong);
		
		if (! $cryptographicallyStrong) {
			// The algorithm used is not cryptographically strong
			$this->app->log->warning(''); // TODO: log warning message
		}
		
		return $sequence;
	}
	
}
