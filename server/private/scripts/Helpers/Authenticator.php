<?php

/*
 * This helpers offers functions to authenticate entities of the application.
 */
class Authenticator extends Helper {
	
	/*
	 * Authenticates a user and returns the result.
	 * 
	 * It receives the user's ID and her alleged password.
	 */
	public function authenticateUser($userId, $userAllegedPassword) {
		$app = $this->app;
		
		// Gets the user
		$user = $app->data->getUser($userId);
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		$userPasswordHash = $user['passwordHash'];
		$userPasswordSalt = $user['passwordSalt'];
		$userPasswordIterations = $user['passwordIterations'];
		
		// Computes the hash of the alleged password, using the stored salt
		$userAllegedPasswordHash = $app->cryptography->hashPassword($userAllegedPassword, $userPasswordSalt, $userPasswordIterations);
		
		// Compares the computed hash with the stored one and returns the result
		return $userAllegedPasswordHash === $userPasswordHash;
	}
	
}
