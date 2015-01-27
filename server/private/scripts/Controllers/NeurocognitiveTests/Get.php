<?php

namespace App\Controllers\NeurocognitiveTests;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/neurocognitive-tests/get
 *	Method:	POST
 */
class Get extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$id = hex2bin($input['id']);
		
		// Starts a read-only transaction
		$app->businessLogicDatabase->startReadOnlyTransaction();
		
		// Gets the neurocognitive test
		$neurocognitiveTest = $app->businessLogicDatabase->getNonErasedNeurocognitiveTest($id);
		
		if (is_null($neurocognitiveTest)) {
			// The neurocognitive test doesn't exist
			
			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_NEUROCOGNITIVE_TEST
			]);
		}
		
		// Filters the neurocognitive test
		$filteredNeurocognitiveTest = $app->dataFilter->filterNeurocognitiveTest($neurocognitiveTest);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
		
		// Sets the output
		$app->response->setBody($filteredNeurocognitiveTest);
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
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
			// TODO: USER_ROLE_OPERATOR?
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
