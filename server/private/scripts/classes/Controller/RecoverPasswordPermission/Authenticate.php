<?php

namespace App\Controller\RecoverPasswordPermission;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/recover-password-permission/authenticate
 * Method:	POST
 */
class Authenticate extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$credentials = $this->getInput('credentials', 'stringsToBinary');
		
		// Authenticates the recover password permission
		$authenticated = $app->authenticator->authenticateRecoverPasswordPermissionByPassword($credentials['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
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
