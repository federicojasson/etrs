<?php

namespace App\Controllers\ClinicalImpressions;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/clinical-impressions/edit
 *	Method:	POST
 */
class Edit extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$id = hex2bin($input['id']);
		$name = trimString($input['name']);
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		if (! $app->businessLogicDatabase->nonErasedClinicalImpressionExists($id)) {
			// The clinical impression doesn't exist
			
			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CLINICAL_IMPRESSION
			]);
		}
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Edits the clinical impression
		$app->businessLogicDatabase->editClinicalImpression($id, $signedInUser['id'], $name);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
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
			}),
			
			'name' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (! is_string($input)) {
					return false;
				}
				
				$input = trimString($input);
				
				return	$app->inputValidator->isNonEmptyString($input) &&
						$app->inputValidator->isBoundedString($input, 128) &&
						$app->inputValidator->isPrintableString($input);
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