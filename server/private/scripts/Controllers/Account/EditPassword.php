<?php

namespace App\Controllers\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/edit-password
 * Method:	POST
 */
class EditPassword extends \App\Controllers\SecureController {
	
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
		$signedInUser = $app->account->getSignedInUser();
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByPassword($signedInUser['id'], $password);
		
		if ($authenticated) {
			// The user was authenticated
			
			// Computes the hash of the new password
			$salt = $app->cryptography->generateSalt();
			$keyDerivationIterations = KEY_DERIVATION_ITERATIONS;
			$newPasswordHash = $app->cryptography->hashPassword($newPassword, $salt, $keyDerivationIterations);
			
			// Edits the user
			$app->webServerDatabase->editUser(
				$signedInUser['id'],
				$newPasswordHash,
				$salt,
				$keyDerivationIterations,
				$signedInUser['role'],
				$signedInUser['firstName'],
				$signedInUser['lastName'],
				$signedInUser['gender'],
				$signedInUser['emailAddress']
			);
		}
		
		// Sets the output
		$app->response->setBody([
			'authenticated' => $authenticated
		]);
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
				return $app->inputValidator->isValidPassword($input);
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
		
		// The service is available only for signed in users
		return $app->account->isUserSignedIn();
	}
	
}
