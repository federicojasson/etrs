<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-backgrounds
 *	Method:	POST
 */
class GetBackgroundsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Selects the backgrounds
		$backgrounds = $app->businessLogicDatabase->selectNonErasedBackgrounds(); // TODO: implement
		
		// Filters the backgrounds
		$filteredBackgrounds = [];
		$count = count($backgrounds);
		for ($i = 0; $i < $count; $i++) {
			$filteredBackgrounds[$i] = $app->dataFilter->filterBackground($backgrounds[$i]);
		}
		
		// Sets the output
		$app->response->setBody($filteredBackgrounds);
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
