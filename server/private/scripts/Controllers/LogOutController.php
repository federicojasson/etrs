<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/log-out
 *	Method:	POST
 */
class LogOutController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		// Logs out the user from the system
		$this->app->authentication->logOutUser();
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
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
