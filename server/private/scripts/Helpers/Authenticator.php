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
		$user = $app->data->getUser($id); // TODO: how to obtain the user?
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		$passwordHash = $user['passwordHash'];
		$passwordSalt = $user['passwordSalt'];
		$passwordIterations = $user['passwordIterations'];
		
		// Computes the hash of the alleged password, using the stored salt
		$allegedPasswordHash = $app->cryptography->hashPassword($allegedPassword, $passwordSalt, $passwordIterations);
		
		// Compares the computed hash with the stored one and returns the result
		return $allegedPasswordHash === $passwordHash;
	}
	
}
