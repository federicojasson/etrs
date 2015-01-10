<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-neurocognitive-evaluations
 *	Method:	POST
 */
class GetNeurocognitiveEvaluationsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		// TODO: implement
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
