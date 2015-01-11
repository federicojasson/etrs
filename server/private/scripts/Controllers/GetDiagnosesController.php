<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-diagnoses
 *	Method:	POST
 */
class GetDiagnosesController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Selects the diagnoses
		$diagnoses = $app->businessLogicDatabase->selectNonErasedDiagnoses();
		
		// Filters the diagnoses
		$filteredDiagnoses = [];
		$count = count($diagnoses);
		for ($i = 0; $i < $count; $i++) {
			$filteredDiagnoses[$i] = $app->dataFilter->filterDiagnosis($diagnoses[$i]);
		}
		
		// Sets the output
		$app->response->setBody($filteredDiagnoses);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			// TODO: add authorized user roles?
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
