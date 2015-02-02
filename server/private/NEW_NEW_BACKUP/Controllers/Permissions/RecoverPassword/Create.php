<?php

namespace App\Controllers\Permissions\RecoverPassword;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/permissions/recover-password/create
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
		$id = $input['id'];
		$emailAddress = $input['emailAddress'];
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByEmailAddress($id, $emailAddress);
		
		if ($authenticated) {
			// The user was authenticated
			
			// Gets the user
			$user = $app->webServerDatabase->getUser($id);
			
			// Creates the recover password permission for the user and sends
			// her an email
			$this->createRecoverPasswordPermissionAndSendEmail($user);
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
				// TODO: implement
			}),
			
			'emailAddress' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
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
	
	/*
	 * Creates a recover password permission for a user and sends her an email.
	 * 
	 * It receives the user.
	 */
	private function createRecoverPasswordPermissionAndSendEmail($user) {
		$app = $this->app;
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->webServerDatabase->recoverPasswordPermissionExists($id));
		
		// Generates a random password and computes its hash
		$password = $app->cryptography->generateRandomPassword();
		$salt = $app->cryptography->generateSalt();
		$keyDerivationIterations = KEY_DERIVATION_ITERATIONS;
		$passwordHash = $app->cryptography->hashPassword($password, $salt, $keyDerivationIterations);
		
		// Creates the recover password permission
		$app->webServerDatabase->createRecoverPasswordPermissionAndSendEmail($id, $user['id'], $passwordHash, $salt, $keyDerivationIterations);
		
		// Gets the server's parameters
		$parameters = $app->parameters->get(PARAMETERS_SERVER);
		$domain = $parameters['domain'];
		
		// Creates an email to be sent to the specified address
		$recipient = [
			'emailAddress' => $user['emailAddress'],
			'name' => $user['firstName'] . ' ' . $user['lastName']
		];
		$url = $domain . '/recover-password/' . bin2hex($id) . '/' . bin2hex($password);
		$email = $app->emailFactory->createRecoverPasswordEmail($recipient, $url);
		
		// Sends the email
		if (! $email->send()) {
			// The email could not be delivered
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_UNDELIVERED_EMAIL
			]);
		}
	}
	
}
