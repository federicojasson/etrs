<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-clinical-impression
 *	Method:	POST
 */
class GetClinicalImpressionController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the clinical impression's ID
		$clinicalImpressionId = hexadecimalToBinary($input['id']);
		
		// Gets the clinical impression
		$clinicalImpression = $app->data->getClinicalImpression($clinicalImpressionId);
		
		if (is_null($clinicalImpression)) {
			// The clinical impression doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_CLINICAL_IMPRESSION
			]);
		}
		
		// Filters the clinical impression
		$filteredClinicalImpression = $app->dataFilter->filterClinicalImpression($clinicalImpression);
		
		// Sets the output
		$app->response->setBody($filteredClinicalImpression);
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
