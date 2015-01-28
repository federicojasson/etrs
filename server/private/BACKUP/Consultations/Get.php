<?php

namespace App\Controllers\Consultations;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/consultations/get
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
		
		// Gets the consultation
		$consultation = $app->businessLogicDatabase->getNonErasedConsultation($id);
		
		if (is_null($consultation)) {
			// The consultation doesn't exist
			
			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CONSULTATION
			]);
		}
		
		// Filters the consultation
		$filteredConsultation = $app->data->filterConsultation($consultation);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
		
		// Sets the output
		$app->response->setBody($filteredConsultation);
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
			// TODO: define user roles
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
