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
		return $this->generateRandomBytesSequence(PASSWORD_SALT_LENGTH);
	}
	
	/*
	 * Computes and returns the hash of a file.
	 * 
	 * It receives the file's path.
	 */
	public function hashFile($filePath) {
		// Applies MD5
		return md5_file($filePath, true);
	}
	
	/*
	 * Computes and returns the hash of a password.
	 * 
	 * It receives the password, the salt and the iterations used in the key
	 * derivation.
	 */
	public function hashPassword($password, $salt, $iterations) {
		// Applies SHA-512 and the PBKDF2 key derivation function
		return hash_pbkdf2('sha512', $password, $salt, $iterations, 0, true);
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
			// The algorithm used is not cryptographically strong
			$app->log->warning(''); // TODO: log warning message
		}
		
		return $sequence;
	}
	
}
