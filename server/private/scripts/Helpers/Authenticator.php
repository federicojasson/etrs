<?php

/*
 * TODO: comments
 */
class Authenticator extends Helper {
	
	/*
	 * TODO: comments
	 */
	public function authenticatePasswordRecoveryRequest() {
		// TODO
	}
	
	/*
	 * TODO: comments
	 */
	public function authenticateUser($userId, $password) {
		$app = $this->app;
		
		// TODO: clean code
		
		// Gets the user
		$user = $app->data->getUser($userId, ['authenticationData']);
		
		if (is_null($user['authenticationData'])) {
			// The user doesn't exist
			return false;
		}
		
		$passwordHash = $user['authenticationData']['passwordHash'];
		$passwordSalt = $user['authenticationData']['passwordSalt'];
		
		$computedPasswordHash = $app->cryptography->hashPasswordSha512($password, $passwordSalt);
		
		return $computedPasswordHash === $passwordHash;
	}
	
	/*
	 * TODO: comments
	 */
	public function authenticateUserCreationRequest() {
		// TODO
	}
	
}
