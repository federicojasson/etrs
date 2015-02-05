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
	 * It receives the recover password permission's credentials.
	 */
	public function authenticateRecoverPasswordPermissionByPassword($credentials) {
		$app = $this->app;
		
		// Gets the recover password permission's ID and password
		$id = $credentials['id'];
		$password = $credentials['password'];
		
		// Gets the recover password permission
		$recoverPasswordPermission = $app->data->recoverPasswordPermission->get($id);
		
		if (is_null($recoverPasswordPermission)) {
			// The recover password permission doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the recover password
			// permission doesn't exist
			$salt = $app->cryptography->generateSalt();
			$keyDerivationIterations = $app->parameters->cryptography['keyDerivationIterations'];
			$app->cryptography->hashPassword($password, $salt, $keyDerivationIterations);
			
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $recoverPasswordPermission['salt'], $recoverPasswordPermission['keyDerivationIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $recoverPasswordPermission['passwordHash'];
	}
	
	/*
	 * Authenticates a sign up permission by its password and returns the
	 * result.
	 * 
	 * It receives the sign up permission's credentials.
	 */
	public function authenticateSignUpPermissionByPassword($credentials) {
		$app = $this->app;
		
		// Gets the sign up permission's ID and password
		$id = $credentials['id'];
		$password = $credentials['password'];
		
		// Gets the sign up permission
		$signUpPermission = $app->data->signUpPermission->get($id);
		
		if (is_null($signUpPermission)) {
			// The sign up permission doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the sign up permission
			// doesn't exist
			$salt = $app->cryptography->generateSalt();
			$keyDerivationIterations = $app->parameters->cryptography['keyDerivationIterations'];
			$app->cryptography->hashPassword($password, $salt, $keyDerivationIterations);
			
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $signUpPermission['salt'], $signUpPermission['keyDerivationIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $signUpPermission['passwordHash'];
	}
	
	/*
	 * Authenticates a user by its password and returns the result.
	 * 
	 * It receives the user's credentials.
	 */
	public function authenticateUserByPassword($credentials) {
		$app = $this->app;
		
		// Gets the user's ID and password
		$id = $credentials['id'];
		$password = $credentials['password'];
		
		// Gets the user
		$user = $app->data->user->get($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the user doesn't exist
			$salt = $app->cryptography->generateSalt();
			$keyDerivationIterations = $app->parameters->cryptography['keyDerivationIterations'];
			$app->cryptography->hashPassword($password, $salt, $keyDerivationIterations);
			
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $user['salt'], $user['keyDerivationIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $user['passwordHash'];
	}
	
}
