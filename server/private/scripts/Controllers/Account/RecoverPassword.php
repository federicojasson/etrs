<?php

namespace App\Controllers\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/recover-password
 * Method:	POST
 */
class RecoverPassword extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// TODO: transactions?
		
		// Gets the input
		$input = $app->request->getBody();
		$id = hex2bin($input['id']);
		$password = $input['password'];
		$newPassword = $input['newPassword'];
		
		// Authenticates the recover password permission
		$authenticated = $app->authenticator->authenticateRecoverPasswordPermissionByPassword($id, $password);
		
		if ($authenticated) {
			// The recover password permission was authenticated
			
			// Gets the recover password permission
			$recoverPasswordPermission = $app->webServerDatabase->getRecoverPasswordPermission($id);
			
			// Gets the user
			$user = $app->webServerDatabase->getUser($recoverPasswordPermission['user']);
			
			// Computes the hash of the new password
			$salt = $app->cryptography->generateSalt();
			$keyDerivationIterations = KEY_DERIVATION_ITERATIONS;
			$newPasswordHash = $app->cryptography->hashPassword($newPassword, $salt, $keyDerivationIterations);
			
			// Edits the user
			$app->webServerDatabase->editUser(
				$user['id'],
				$newPasswordHash,
				$salt,
				$keyDerivationIterations,
				$user['role'],
				$user['firstName'],
				$user['lastName'],
				$user['gender'],
				$user['emailAddress']
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
			'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isNonEmptyString($input);
			}),
			
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
		
		// The service is available only for users not signed in
		return ! $app->account->isUserSignedIn();
	}
	
}
