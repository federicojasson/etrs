<?php

namespace App\Controller\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/account/sign-out
 * Method:	POST
 */
class SignOut extends \App\Controller\SpecializedExternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Signs out the user from the system
		$app->authentication->signOutUser();
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
		
		// The service is available only to signed in users
		return $app->authentication->isUserSignedIn();
	}
	
}
