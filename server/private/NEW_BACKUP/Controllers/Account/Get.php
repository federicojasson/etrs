<?php

namespace App\Controllers\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/get
 * Method:	POST
 */
class Get extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Starts a read-only transaction
		$app->webServerDatabase->startReadOnlyTransaction();
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Filters the signed in user
		$filteredSignedInUser = $app->data->filterSignedInUser($signedInUser); // TODO: implement
		
		// Commits the transaction
		$app->webServerDatabase->commitTransaction();
		
		// Sets the output
		$app->response->setBody($filteredSignedInUser);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
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
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
