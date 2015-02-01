<?php

namespace App\Controllers\ClinicalImpressions;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/clinical-impressions/create
 * Method:	POST
 */
class Create extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// TODO: transactions
		
		// Gets the input
		$input = $app->request->getBody();
		$name = trimString($input['name']);
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->businessLogicDatabase->clinicalImpressionExists($id));
		
		// Gets the signed in user
		$signedInUser = $app->account->getSignedInUser();
		
		// Creates the clinical impression
		$app->businessLogicDatabase->createClinicalImpression($id, $signedInUser['id'], $signedInUser['id'], $name);
		
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
