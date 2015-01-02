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
		// TODO: implement
		$this->app->response->setBody([
			'1894068380304e0ca7ebf25d25e72dca'
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// TODO: implement
		return true;
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
