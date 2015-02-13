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
		return $this->generateRandomBytesSequence(LENGTH_RANDOM_ID);
	}
	
	/*
	 * Generates and returns a random password.
	 */
	public function generateRandomPassword() {
		return $this->generateRandomBytesSequence(LENGTH_RANDOM_PASSWORD);
	}
	
	/*
	 * Computes and returns the hash of a file.
	 * 
	 * It receives the file's path.
	 */
	public function hashFile($path) {
		$app = $this->app;
		
		// Since the hashing of a file can take some time, the timeout limit is
		// extended
		$app->webServer->extendTimeoutLimitForFileHashing();
		
		// Applies MD5
		return md5_file($path, true);
	}
	
	/*
	 * Computes the hash of a password and returns it in an array, containing
	 * also the salt used and the number of iterations that were applied in the
	 * key stretching.
	 * 
	 * It receives the password.
	 */
	public function hashNewPassword($password) {
		$app = $this->app;
		
		// Generates a salt
		$salt = $this->generateSalt();
		
		// Gets the number of iterations that should be applied in the key
		// stretching
		$keyStretchingIterations = $app->parameters->cryptography['keyStretchingIterations'];
		
		// Computes the hash of the password
		$passwordHash = $this->hashPassword($password, $salt, $keyStretchingIterations);
		
		return [ $passwordHash, $salt, $keyStretchingIterations ];
	}
	
	/*
	 * Computes and returns the hash of a password.
	 * 
	 * It receives the password, the salt and the number of iterations to apply
	 * in the key stretching.
	 */
	public function hashPassword($password, $salt, $keyStretchingIterations) {
		$app = $this->app;
		
		// Since the hashing of a password can take some time, the timeout limit
		// is extended
		$app->webServer->extendTimeoutLimitForPasswordHashing();
		
		// Applies SHA-512 and the PBKDF2 key derivation function
		return hash_pbkdf2('sha512', $password, $salt, $keyStretchingIterations, 0, true);
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
	
	/*
	 * Generates and returns a salt.
	 */
	private function generateSalt() {
		return $this->generateRandomBytesSequence(LENGTH_SALT);
	}
	
}
