<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-laboratory-tests
 *	Method:	POST
 */
class GetLaboratoryTestsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Selects the laboratory tests
		$laboratoryTests = $app->businessLogicDatabase->selectNonErasedLaboratoryTests(); // TODO: implement
		
		// Filters the laboratory tests
		$filteredLaboratoryTests = [];
		$count = count($laboratoryTests);
		for ($i = 0; $i < $count; $i++) {
			$filteredLaboratoryTests[$i] = $app->dataFilter->filterLaboratoryTest($laboratoryTests[$i]);
		}
		
		// Sets the output
		$app->response->setBody($filteredLaboratoryTests);
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
