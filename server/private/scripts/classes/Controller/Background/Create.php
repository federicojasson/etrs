<?php

namespace App\Controller\Background;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/background/create
 * Method:	POST
 */
class Create extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$name = $this->getInput('name', 'trimString');
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Creates the background
		$app->data->background->create($id, $signedInUser['id'], $name);
		
		// Sets an output
		$this->setOutput('id', $id, 'bin2hex');
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'name' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 1, 128);
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
