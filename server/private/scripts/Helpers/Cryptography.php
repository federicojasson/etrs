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
	 * Generates and returns a UUID v4.
	 */
	public function generateUuidV4() {
		// Generates 16 random bytes
		$bytes = $this->generateRandomBytes(16);
		
		// Sets the fixed bits of the UUID v4 to meet the RFC 4122 standard
		$bytes[6] = chr(ord($bytes[6]) & 0x0f | 0x40);
		$bytes[8] = chr(ord($bytes[8]) & 0x3f | 0x80);
		
		return $bytes;
	}
	
	/*
	 * Computes and returns the hash of a file.
	 * 
	 * It receives the file's path.
	 */
	public function hashFile($filePath) {
		// Applies the MD5 hash function
		return md5_file($filePath, true);
	}
	
	/*
	 * Computes and returns the hash of a password.
	 * 
	 * It receives the password and the salt to use.
	 */
	public function hashPassword($password, $salt, $iterations) {
		// Applies the SHA-512 hash function and the PBKDF2 key derivation
		return hash_pbkdf2(ALGORITHM_HASH_SHA512, $password, $salt, $iterations, 0, true);
	}
	
	/*
	 * Generates and returns a random byte sequence.
	 * 
	 * It receives the length of the sequence.
	 */
	private function generateRandomBytes($length) {
		// Generates the random bytes
		$bytes = openssl_random_pseudo_bytes($length, $cryptographicallyStrong);
		
		if (! $cryptographicallyStrong) {
			// The algorithm used is not cryptographically strong
			$this->app->log->warning(''); // TODO: log warning message
		}
		
		return $bytes;
	}
	
}
