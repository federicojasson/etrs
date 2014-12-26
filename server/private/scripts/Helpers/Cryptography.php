<?php

/*
 * This helper offers cryptography-related functions.
 */
class Cryptography extends Helper {
	
	/*
	 * Generates and returns a password salt.
	 */
	public function generatePasswordSalt() {
		return $this->generateRandomBytes(PASSWORD_SALT_LENGTH);
	}
	
	/*
	 * Generates and returns a random ID.
	 */
	public function generateRandomId() {
		return $this->generateRandomBytes(RANDOM_ID_LENGTH);
	}
	
	/*
	 * Generates and returns a random password.
	 */
	public function generateRandomPassword() {
		return $this->generateRandomBytes(RANDOM_PASSWORD_LENGTH);
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
	 * It receives the password, the salt and the key derivation iterations.
	 */
	public function hashPassword($password, $salt, $iterations) {
		// Applies SHA-512 and the PBKDF2 key derivation function
		return hash_pbkdf2('sha512', $password, $salt, $iterations, 0, true);
	}
	
	/*
	 * Generates and returns a random byte sequence.
	 * 
	 * It receives the length of the sequence.
	 */
	private function generateRandomBytes($length) {
		$cryptographicallyStrong = false;
		
		// Generates the random bytes
		$bytes = openssl_random_pseudo_bytes($length, $cryptographicallyStrong);
		
		if (! $cryptographicallyStrong) {
			// The algorithm used is not cryptographically strong
			$this->app->log->warning(''); // TODO: log warning message
		}
		
		return $bytes;
	}
	
}
