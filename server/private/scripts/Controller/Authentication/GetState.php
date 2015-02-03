<?php

namespace App\Controller\Authentication;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/authentication/get-state
 * Method:	POST
 */
class GetState extends \App\Controller\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		if ($app->authentication->isUserSignedIn()) {
			// The user is signed in
			
			// Gets the signed in user
			$signedInUser = $app->authentication->getSignedInUser();
			
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
		// The service is available to all users
		return true;
	}
	
}
