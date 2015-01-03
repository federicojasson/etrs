<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/search-patients
 *	Method:	POST
 */
class SearchPatientsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the query
		$query = $input['query'];
		
		// Searches the patients
		$patientIds = $app->businessLogicDatabase->selectNonErasedPatientIdsByQuery($query);
		
		// Filters the patient IDs
		$filteredPatientIds = [];
		$count = count($patientIds);
		for ($i = 0; $i < $count; $i++) {
			$filteredPatientIds[$i] = bin2hex($patientIds[$i]['id']); // TODO: do it directly?
		}
		
		// Sets the output
		$app->response->setBody($filteredPatientIds);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		$inputValidator = $app->inputValidator;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'query' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				return $inputValidator->isValidQuery($jsonValue);
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
			// TODO: check authorized user roles
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
