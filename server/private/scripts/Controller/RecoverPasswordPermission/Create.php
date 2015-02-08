<?php

namespace App\Controller\RecoverPasswordPermission;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/recover-password-permission/create
 * Method:	POST
 */
class Create extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$credentials = $this->getInput('credentials');
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByEmailAddress($credentials['id'], $credentials['emailAddress']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The user was not authenticated
			return;
		}
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Gets the user
		$user = $app->data->user->get($credentials['id']);
		
		// Generates a random password
		$password = $app->cryptography->generateRandomPassword();
		
		// Computes the hash of the password
		list($passwordHash, $salt, $keyStretchingIterations) = $app->cryptography->hashNewPassword($password);
		
		// Creates the recover password permission
		$app->data->recoverPasswordPermission->create($id, $user['id'], $passwordHash, $salt, $keyStretchingIterations);
		
		// Initializes the recipient of the email
		$recipient = [
			'name' => $user['firstName'] . $user['lastName'],
			'emailAddress' => $user['emailAddress']
		];
		
		// Creates a recover password email
		$email = $app->emails->createRecoverPasswordEmail($id, $password, $recipient); // TODO: create email (what parameters?)
		
		// Sends the email
		$delivered = $email->send();
		
		if (! $delivered) {
			// The email could not be delivered
			
			// Deletes the just created recover password permission
			$app->data->recoverPasswordPermission->delete($id);
			
			// TODO: do this somewhere else
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_UNDELIVERED_EMAIL
			]);
		}
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'credentials' => new JsonObjectDescriptor([
				'id' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				}),
				
				'emailAddress' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			])
		]);
		
		// Validates the JSON request and returns the result
		return $this->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// The service is available only to users not signed in
		return ! $app->authentication->isUserSignedIn();
	}
	
}
