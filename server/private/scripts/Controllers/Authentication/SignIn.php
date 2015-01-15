<?php

namespace App\Controllers\Authentication;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/authentication/sign-in
 *	Method:	POST
 */
class SignIn extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		// TODO: Controllers/Authentication/SignIn.php
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// TODO: Controllers/Authentication/SignIn.php
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ANONYMOUS
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}
	
}
