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
	 * Generates and returns a random byte sequence.
	 * 
	 * It receives the length of the sequence.
	 */
	public function generateRandomBytes($length) {
		// Generates the random bytes
		$bytes = openssl_random_pseudo_bytes($length, $cryptographicallyStrong);
		
		if (! $cryptographicallyStrong) {
			// The algorithm used is not cryptographically strong
			// TODO: log warning message
		}
		
		return $bytes;
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
	 * Computes and returns the hash of a file, applying the MD5 hash function.
	 * 
	 * It receives the file's path.
	 */
	public function hashFileMd5($filePath) {
		return md5_file($filePath, true);
	}
	
	/*
	 * Computes and returns the hash of a password, applying the SHA-512 hash
	 * function and the PBKDF2 key derivation function.
	 * 
	 * It receives the password and the salt to use.
	 */
	public function hashPasswordSha512($password, $salt) {
		return hash_pbkdf2(ALGORITHM_HASH_SHA512, $password, $salt, PASSWORD_HASH_ITERATIONS, 0, true);
	}
	
}
