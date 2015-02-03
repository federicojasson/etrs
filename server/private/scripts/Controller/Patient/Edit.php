<?php

namespace App\Controller\Patient;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/patient/edit
 * Method:	POST
 */
class Edit extends \App\Controller\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$id = hex2bin($input['id']);
		$firstName = trimString($input['firstName']);
		$lastName = trimString($input['lastName']);
		$gender = $input['gender'];
		$birthDate = $input['birthDate'];
		$educationYears = $input['educationYears'];
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		if (! $app->businessLogicDatabase->nonDeletedPatientExists($id)) {
			// The patient doesn't exist
			
			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_PATIENT
			]);
		}
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Edits the patient
		$app->businessLogicDatabase->editPatient($id, $signedInUser['id'], $firstName, $lastName, $gender, $birthDate, $educationYears);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'id' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'firstName' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 1, 48);
			}),
			
			'lastName' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 1, 48);
			}),
			
			'gender' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isGender($input);
			}),
			
			'birthDate' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isDate($input);
			}),
			
			'educationYears' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isBoundedInteger($input, 0, 100);
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
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
