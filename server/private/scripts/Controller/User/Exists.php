<?php

namespace App\Controller\User;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/user/exists
 * Method:	POST
 */
class Exists extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$credentials = $this->getInput('credentials', 'stringsToBinary');
		$id = $this->getInput('id');
		
		// Authenticates the sign up permission
		$authenticated = $app->authenticator->authenticateSignUpPermissionByPassword($credentials['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The sign up permission was not authenticated
			return;
		}
		
		// Determines whether the user exists
		$exists = $app->data->user->exists($id);
		
		// Sets an output
		$this->setOutput('exists', $exists);
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
					return $app->inputValidator->isRandomId($input);
				}),
				
				'password' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isRandomPassword($input);
				})
			]),
			
			'id' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isUserId($input);
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
