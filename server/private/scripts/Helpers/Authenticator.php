<?php

/*
 * This helpers offers functions to authenticate entities of the application,
 * such as users and requests.
 */
class Authenticator extends Helper {
	
	/*
	 * Authenticates a password recovery request and returns the result.
	 */
	public function authenticatePasswordRecoveryRequest() {
		// TODO: implement
	}
	
	/*
	 * Authenticates a user and returns the result.
	 * 
	 * It receives the user's ID and her alleged password.
	 */
	public function authenticateUser($userId, $allegedPassword) {
		$app = $this->app;
		
		// Gets the user
		$user = $app->data->getUser($userId, ['authenticationData']);
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		// Gets the user's authentication data
		$userPasswordHash = $user['authenticationData']['passwordHash'];
		$userPasswordSalt = $user['authenticationData']['passwordSalt'];
		
		// Computes the hash of the alleged password, using the stored salt
		$allegedPasswordHash = $app->cryptography->hashPassword($allegedPassword, $userPasswordSalt);
		
		// Compares the computed hash with the stored one and returns the result
		return $allegedPasswordHash === $userPasswordHash;
	}
	
	/*
	 * Authenticates a user creation request and returns the result.
	 */
	public function authenticateUserCreationRequest() {
		// TODO: implement
	}
	
}
