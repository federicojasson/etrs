<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-treatments
 *	Method:	POST
 */
class GetTreatmentsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Selects the treatments
		$treatments = $app->businessLogicDatabase->selectNonErasedTreatments(); // TODO: implement
		
		// Filters the treatments
		$filteredTreatments = [];
		$count = count($treatments);
		for ($i = 0; $i < $count; $i++) {
			$filteredTreatments[$i] = $app->dataFilter->filterTreatment($treatments[$i]);
		}
		
		// Sets the output
		$app->response->setBody($filteredTreatments);
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
