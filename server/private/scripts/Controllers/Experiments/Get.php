<?php

namespace App\Controllers\Experiments;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/experiments/get
 * Method:	POST
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
		
		// Gets the experiment
		$experiment = $app->businessLogicDatabase->getNonDeletedExperiment($id);
		
		if (is_null($experiment)) {
			// The experiment doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_EXPERIMENT
			]);
		}
		
		// Filters the experiment
		$filteredExperiment = $app->data->filterExperiment($experiment);
		
		// Sets the output
		$app->response->setBody($filteredExperiment);
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
			USER_ROLE_OPERATOR
		];
		
		// Validates the account and returns the result
		return $app->authorizationValidator->validateAccount($authorizedUserRoles);
	}
	
}
