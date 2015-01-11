<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-medications
 *	Method:	POST
 */
class GetMedicationsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Selects the medications
		$medications = $app->businessLogicDatabase->selectNonErasedMedications();
		
		// Filters the medications
		$filteredMedications = [];
		$count = count($medications);
		for ($i = 0; $i < $count; $i++) {
			$filteredMedications[$i] = $app->dataFilter->filterMedication($medications[$i]);
		}
		
		// Sets the output
		$app->response->setBody($filteredMedications);
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
