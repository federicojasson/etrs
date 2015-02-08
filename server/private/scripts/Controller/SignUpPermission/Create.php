<?php

namespace App\Controller\SignUpPermission;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/sign-up-permission/create
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
		$recipient = $this->getInput('recipient');
		$role = $this->getInput('role');
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByPassword($signedInUser['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The user was not authenticated
			return;
		}
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Generates a random password
		$password = $app->cryptography->generateRandomPassword();
		
		// Computes the hash of the password
		list($passwordHash, $salt, $keyStretchingIterations) = $app->cryptography->hashNewPassword($password);
		
		// Creates the sign up permission
		$app->data->signUpPermission->create($id, $signedInUser['id'], $passwordHash, $salt, $keyStretchingIterations, $role);
		
		// Creates a sign up email
		$email = $app->emails->createSignUpEmail($id, $password, $recipient); // TODO: create email (what parameters?)
		
		// Sends the email
		$delivered = $email->send();
		
		if (! $delivered) {
			// The email could not be delivered
			
			// Deletes the just created sign up permission
			$app->data->signUpPermission->delete($id);
			
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
				'password' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			]),
			
			'recipient' => new JsonObjectDescriptor([
				'name' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 0);
				}),
				
				'emailAddress' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isEmailAddress($input);
				})
			]),
			
			'role' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isUserRole($input);
			})
		]);
		
		// Validates the JSON request and returns the result
		return $this->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
