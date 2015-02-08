<?php

namespace App\Controller\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/get
 * Method:	POST
 */
class Get extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Gets the user
		$user = $this->getUser($signedInUser['id']);
		
		// Filters the user
		$user = $app->data->user->filter($user); // TODO: how to different it from the other case
		
		// Sets the output
		$this->setEntireOutput($user);
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
