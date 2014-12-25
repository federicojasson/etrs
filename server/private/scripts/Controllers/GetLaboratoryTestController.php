<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-laboratory-test
 *	Method:	POST
 */
class GetLaboratoryTestController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the laboratory test's ID
		$laboratoryTestId = hexadecimalToBinary($input['id']);
		
		// Gets the laboratory test
		$laboratoryTest = $app->data->getLaboratoryTest($laboratoryTestId);
		
		if (is_null($laboratoryTest)) {
			// The laboratory test doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_LABORATORY_TEST
			]);
		}
		
		// Filters the laboratory test
		$filteredLaboratoryTest = $app->dataFilter->filterLaboratoryTest($laboratoryTest);
		
		// Sets the output
		$app->response->setBody($filteredLaboratoryTest);
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
			// TODO: define authorized user roles
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
