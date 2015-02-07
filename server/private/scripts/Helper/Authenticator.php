<?php

namespace App\Helper;

/*
 * This helpers offers functions to authenticate different entities.
 */
class Authenticator extends Helper {
	
	/*
	 * Authenticates a recover password permission by its password and returns
	 * the result.
	 * 
	 * It receives the recover password permission's ID and password.
	 */
	public function authenticateRecoverPasswordPermissionByPassword($id, $password) {
		$app = $this->app;
		
		// Gets the recover password permission
		$recoverPasswordPermission = $app->data->recoverPasswordPermission->get($id);
		
		if (is_null($recoverPasswordPermission)) {
			// The recover password permission doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the recover password
			// permission doesn't exist
			$app->cryptography->hashNewPassword($password);
			
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $recoverPasswordPermission['salt'], $recoverPasswordPermission['keyStretchingIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $recoverPasswordPermission['passwordHash'];
	}
	
	/*
	 * Authenticates a sign up permission by its password and returns the
	 * result.
	 * 
	 * It receives the sign up permission's ID and password.
	 */
	public function authenticateSignUpPermissionByPassword($id, $password) {
		$app = $this->app;
		
		// Gets the sign up permission
		$signUpPermission = $app->data->signUpPermission->get($id);
		
		if (is_null($signUpPermission)) {
			// The sign up permission doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the sign up permission
			// doesn't exist
			$app->cryptography->hashNewPassword($password);
			
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $signUpPermission['salt'], $signUpPermission['keyStretchingIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $signUpPermission['passwordHash'];
	}
	
	/*
	 * Authenticates a user by its email address and returns the result.
	 * 
	 * It receives the user's ID and email address.
	 */
	public function authenticateUserByEmailAddress($id, $emailAddress) {
		$app = $this->app;
		
		// Gets the user
		$user = $app->data->user->get($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		// Compares the email address with the stored one and returns the result
		return $emailAddress === $user['emailAddress'];
	}
	
	/*
	 * Authenticates a user by its password and returns the result.
	 * 
	 * It receives the user's ID and password.
	 */
	public function authenticateUserByPassword($id, $password) {
		$app = $this->app;
		
		// Gets the user
		$user = $app->data->user->get($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the user doesn't exist
			$app->cryptography->hashNewPassword($password);
			
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $user['salt'], $user['keyStretchingIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $user['passwordHash'];
	}
	
}
