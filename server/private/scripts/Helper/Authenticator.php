<?php

namespace App\Helper;

/*
 * This helpers offers functions to authenticate different entities.
 */
class Authenticator extends Helper {
	
	/*
	 * Authenticates a user by her password and returns the result.
	 * 
	 * It receives the user's credentials.
	 */
	public function authenticateUserByPassword($credentials) {
		$app = $this->app;
		
		// Gets the user's ID and password
		$id = $credentials['id'];
		$password = $credentials['password'];
		
		// Gets the user
		$user = $app->webServerDatabase->getUser($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $user['salt'], $user['keyDerivationIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $user['passwordHash'];
	}
	
}
