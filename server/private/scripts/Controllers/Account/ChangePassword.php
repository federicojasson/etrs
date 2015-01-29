<?php

namespace App\Controllers\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/change-password
 * Method:	POST
 */
class ChangePassword extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$password = $input['password'];
		$newPassword = $input['newPassword'];
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		if (! $app->authenticator->authenticateUser($signedInUser['id'], $password)) {
			// The user was not authenticated
			
			// TODO: output?
			
			return;
		}
		
		// Computes the hash of the new password
		$salt = $app->cryptography->generateSalt();
		$keyDerivationIterations = KEY_DERIVATION_ITERATIONS;
		$newPasswordHash = $app->cryptography->hashPassword($newPassword, $salt, $keyDerivationIterations);
		
		// Edits the user
		$app->webServerDatabase->editUser($signedInUser['id'], $newPasswordHash, $salt, $keyDerivationIterations, $signedInUser['firstName'], $signedInUser['lastName'], $signedInUser['gender'], $signedInUser['emailAddress'], $signedInUser['role']);
		
		// TODO: output?
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'password' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isNonEmptyString($input);
			}),
			
			'newPassword' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isPassword($input);
			})
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
