<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/erase-neurocognitive-test
 *	Method:	POST
 */
class EraseNeurocognitiveTestController extends SecureController {
	
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
		$neurocognitiveTestId = $input['id'];
		
		if (! $businessLogicDatabase->nonErasedNeurocognitiveTestExists($neurocognitiveTestId)) { // TODO: check or implement
			// The neurocognitive test doesn't exist or has already been erased
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_NEUROCOGNITIVE_TEST
			]);
		}
		
		// Erases the neurocognitive test
		$businessLogicDatabase->eraseNeurocognitiveTest($neurocognitiveTestId); // TODO: implement
		
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
			'id' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				return $inputValidator->isValidRandomId($jsonValue);
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
