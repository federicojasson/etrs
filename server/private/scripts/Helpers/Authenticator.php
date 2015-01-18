<?php

namespace App\Helpers;

/*
 * This helpers offers functions to authenticate different entities.
 */
class Authenticator extends \App\Helpers\Helper {
	
	/*
	 * Authenticates a user and returns the result.
	 * 
	 * It receives the user's ID and her alleged password.
	 */
	public function authenticateUser($id, $allegedPassword) {
		$app = $this->app;
		
		// Gets the user
		$user = $app->webServerDatabase->getUser($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		$passwordHash = $user['passwordHash'];
		$salt = $user['salt'];
		$keyDerivationIterations = $user['keyDerivationIterations'];
		
		// Computes the hash of the alleged password, using the stored salt
		$allegedPasswordHash = $app->cryptography->hashPassword($allegedPassword, $salt, $keyDerivationIterations);
		
		// Compares the computed hash with the stored one and returns the result
		return $allegedPasswordHash === $passwordHash;
	}
	
}
