<?php

namespace App\Controller\Authentication;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/authentication/get-state
 * Method:	POST
 */
class GetState extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Determines whether the user is signed in
		$signedIn = $app->authentication->isUserSignedIn();
		
		// Sets an output
		$this->setOutput('signedIn', $signedIn);
		
		if (! $signedIn) {
			// The user is not signed in
			return;
		}
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Sets an output
		$this->setOutput('user', $signedInUser['id']);
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
		// The service is available to all users
		return true;
	}
	
}
