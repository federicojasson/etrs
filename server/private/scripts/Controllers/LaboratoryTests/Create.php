<?php

namespace App\Controllers\LaboratoryTests;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/laboratory-tests/create
 *	Method:	POST
 */
class Create extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$name = trimString($input['name']);
		$dataTypeDefinition = $input['dataTypeDefinition']; // TODO: process somehow?
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->businessLogicDatabase->laboratoryTestExists($id));
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Creates the laboratory test
		$app->businessLogicDatabase->createLaboratoryTest($id, $signedInUser['id'], $signedInUser['id'], $name, $dataTypeDefinition);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
		
		// Sets the output
		$app->response->setBody([
			'id' => bin2hex($id)
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'name' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (! is_string($input)) {
					return false;
				}
				
				$input = trimString($input);
				
				return	$app->inputValidator->isNonEmptyString($input) &&
						$app->inputValidator->isBoundedString($input, 128) &&
						$app->inputValidator->isPrintableString($input);
			}),
			
			'dataTypeDefinition' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isDataTypeDefinition($input);
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
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
