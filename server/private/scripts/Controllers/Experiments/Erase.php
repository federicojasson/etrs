<?php

namespace App\Controllers\Experiments;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/experiments/erase
 *	Method:	POST
 */
class Erase extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		// TODO: Controllers/Experiments/Erase.php
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// TODO: Controllers/Experiments/Erase.php
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}
	
}
