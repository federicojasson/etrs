<?php

namespace App\Controllers\NeurocognitiveTests;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/neurocognitive-tests/delete
 * Method:	POST
 */
class Delete extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$id = hex2bin($input['id']);
		
		if (! $app->businessLogicDatabase->nonDeletedNeurocognitiveTestExists($id)) {
			// The neurocognitive test doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_NEUROCOGNITIVE_TEST
			]);
		}
		
		// Deletes the neurocognitive test
		$app->businessLogicDatabase->deleteNeurocognitiveTest($id);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
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
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the account and returns the result
		return $app->authorizationValidator->validateAccount($authorizedUserRoles);
	}
	
}