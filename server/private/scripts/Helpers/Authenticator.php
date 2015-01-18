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
		
		// Computes the hash of the alleged password, using the salt
		$allegedPasswordHash = $app->cryptography->hashPassword($allegedPassword, $user['salt'], $user['keyDerivationIterations']);
		
		// Compares the password hashes and returns the result
		return $allegedPasswordHash === $user['passwordHash'];
	}
	
}
