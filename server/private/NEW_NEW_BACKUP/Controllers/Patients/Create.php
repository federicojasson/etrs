<?php

namespace App\Controllers\Patients;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/patients/create
 * Method:	POST
 */
class Create extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$firstName = trimString($input['firstName']);
		$lastName = trimString($input['lastName']);
		$gender = $input['gender'];
		$birthDate = $input['birthDate'];
		$educationYears = $input['educationYears'];
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->businessLogicDatabase->patientExists($id));
		
		// Gets the signed in user
		$signedInUser = $app->account->getSignedInUser();
		
		// Creates the patient
		$app->businessLogicDatabase->createPatient($id, $signedInUser['id'], $signedInUser['id'], $firstName, $lastName, $gender, $birthDate, $educationYears);
		
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
			'firstName' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (! is_string($input)) {
					return false;
				}
				
				$input = trimString($input);
				
				return	$app->inputValidator->isNonEmptyString($input) &&
						$app->inputValidator->isValidString($input, 48) &&
						$app->inputValidator->isPrintableString($input);
			}),
			
			'lastName' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (! is_string($input)) {
					return false;
				}
				
				$input = trimString($input);
				
				return	$app->inputValidator->isNonEmptyString($input) &&
						$app->inputValidator->isValidString($input, 48) &&
						$app->inputValidator->isPrintableString($input);
			}),
			
			'gender' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isGender($input);
			}),
			
			'birthDate' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isDate($input);
			}),
			
			'educationYears' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return	$app->inputValidator->isNonNegativeInteger($input) &&
						$app->inputValidator->isBoundedInteger($input, 100);
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
		];
		
		// Validates the account and returns the result
		return $app->authorizationValidator->validateAccount($authorizedUserRoles);
	}
	
}
