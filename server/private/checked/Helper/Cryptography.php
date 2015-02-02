<?php

namespace App\Helper;

/*
 * This helper offers cryptography-related functionalities.
 */
class Cryptography extends Helper {
	// TODO: implement methods
	
	/*
	 * Generates and returns a random ID.
	 */
	public function generateRandomId() {
		return $this->generateRandomBytesSequence(RANDOM_ID_LENGTH);
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
