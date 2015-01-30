<?php

namespace App\Controllers\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/get-state
 * Method:	POST
 */
class GetState extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		if ($app->account->isUserSignedIn()) {
			// The user is signed in
			
			// Gets the signed in user
			$signedInUser = $app->account->getSignedInUser();
			
			// Defines the output
			$output = [
				'signedIn' => true,
				'user' => $signedInUser['id']
			];
		} else {
			// The user is not signed in
			
			// Defines the output
			$output = [
				'signedIn' => false
			];
		}
		
		// Sets the output
		$app->response->setBody($output);
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
		// The service is available for all users
		return true;
	}
	
}
