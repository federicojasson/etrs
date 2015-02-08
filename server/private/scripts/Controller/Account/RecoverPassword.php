<?php

namespace App\Controller\Account;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/recover-password
 * Method:	POST
 */
class RecoverPassword extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$credentials = $this->getInput('credentials');
		$password = $this->getInput('password');
		
		// Authenticates the recover password permission
		$authenticated = $app->authenticator->authenticateRecoverPasswordPermissionByPassword($credentials['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The recover password permission was not authenticated
			return;
		}
		
		// Gets the recover password permission
		$recoverPasswordPermission = $app->data->recoverPasswordPermission->get($credentials['id']);
		
		// Gets the user
		$user = $app->data->user->get($recoverPasswordPermission['user']);
		
		// Computes the hash of the password
		list($passwordHash, $salt, $keyStretchingIterations) = $app->cryptography->hashNewPassword($password);
		
		// Edits the user
		$app->data->user->edit($user['id'], $passwordHash, $salt, $keyStretchingIterations, $user['firstName'], $user['lastName'], $user['gender'], $user['emailAddress']);
		
		// TODO: remove permission here or before edition? o during transaction?
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
				
				'password' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			]),
			
			'password' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidPassword($input);
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
		
		// The service is available only to users not signed in
		return ! $app->authentication->isUserSignedIn();
	}
	
}
