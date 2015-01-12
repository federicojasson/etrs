<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/create-treatment
 *	Method:	POST
 */
class CreateTreatmentController extends SecureController {
	
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
		$name = $input['name'];
		
		// Gets the logged in user's ID
		$creator = $app->authentication->getLoggedInUser()['id'];
		
		// Generate a random ID
		do {
			$id = $app->cryptography->generateRandomId();
		} while ($businessLogicDatabase->treatmentExists($id));
		
		// Inserts the treatment
		$businessLogicDatabase->insertTreatment($id, $creator, $name);
		
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
			'name' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
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
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
