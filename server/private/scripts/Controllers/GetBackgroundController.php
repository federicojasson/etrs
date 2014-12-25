<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-background
 *	Method:	POST
 */
class GetBackgroundController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the background's ID
		$backgroundId = hex2bin($input['id']);
		
		// Gets the background
		$background = $app->data->getBackground($backgroundId);
		
		if (is_null($background)) {
			// The background doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_BACKGROUND
			]);
		}
		
		// Filters the background
		$filteredBackground = $app->dataFilter->filterBackground($background);
		
		// Sets the output
		$app->response->setBody($filteredBackground);
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
