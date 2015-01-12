<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/create-patient
 *	Method:	POST
 */
class CreatePatientController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		$businessLogicDatabase = $app->businessLogicDatabase;
		
		// Starts a transaction
		$businessLogicDatabase->startTransaction();
		
		// Gets the input
		$input = $app->request->getBody();
		$firstNames = $input['firstNames'];
		$lastNames = $input['lastNames'];
		$gender = $input['gender'];
		$birthDate = $input['birthDate'];
		$educationYears = $input['educationYears'];
		
		// Gets the logged in user's ID
		$creator = $app->authentication->getLoggedInUser()['id'];
		
		// Generate a random ID
		do {
			$id = $app->cryptography->generateRandomId();
		} while ($businessLogicDatabase->patientExists($id));
		
		// Inserts the patient
		$businessLogicDatabase->insertPatient($id, $creator, $firstNames, $lastNames, $gender, $birthDate, $educationYears);
		
		// Sets the output
		$app->response->setBody([
			'id' => bin2hex($id)
		]);
		
		// Commits the transaction
		$businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		$inputValidator = $app->inputValidator;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'firstNames' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				// TODO: implement
				return true;
			}),
			
			'lastNames' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				// TODO: implement
				return true;
			}),
			
			'gender' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				// TODO: implement
				return true;
			}),
			
			'birthDate' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				// TODO: implement
				return true;
			}),
			
			'educationYears' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				// TODO: implement
				return true;
			})
		]);
		
		// Validates the request and returns the result
		return $inputValidator->validateJsonRequest($app->request, $jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
