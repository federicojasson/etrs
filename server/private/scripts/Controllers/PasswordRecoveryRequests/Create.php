<?php

namespace App\Controllers\PasswordRecoveryRequests;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/password-recovery-requests/create
 * Method:	POST
 */
class Create extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$user = $input['user'];
		$emailAddress = $input['emailAddress'];
		
		// TODO: user authentication
		
		// Starts a read-write transaction
		$app->webServerDatabase->startReadWriteTransaction();
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->webServerDatabase->passwordRecoveryRequestExists($id));
		
		// Generates a random password and computes its hash
		$password = $app->cryptography->generateRandomPassword();
		$salt = $app->cryptography->generateSalt();
		$keyDerivationIterations = KEY_DERIVATION_ITERATIONS;
		$passwordHash = $app->cryptography->hashPassword($password, $salt, $keyDerivationIterations);
		
		// Creates the password recovery request
		$app->webServerDatabase->createPasswordRecoveryRequest($id, $user, $passwordHash, $salt, $keyDerivationIterations);
		
		// Creates an email to be sent to the specified address
		$email = $app->emailFactory->createPasswordRecoveryEmail($recipient, $url); // TODO: parameters
		
		// Sends the email
		if (! $email->send()) {
			// The email could not be delivered
			
			// Rolls back the transaction
			$app->webServerDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_UNDELIVERED_EMAIL
			]);
		}
		
		// Commits the transaction
		$app->webServerDatabase->commitTransaction();
		
		// TODO: output?
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'user' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($inputValidator) {
				return $app->inputValidator->isNonEmptyString($input);
			}),
			
			'emailAddress' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($inputValidator) {
				return $app->inputValidator->isNonEmptyString($input);
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
			USER_ROLE_ANONYMOUS
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
