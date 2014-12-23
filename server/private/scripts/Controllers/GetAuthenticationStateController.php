<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-authentication-state
 *	Method:	POST
 */
class GetAuthenticationStateController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		$authentication = $app->authentication;
		
		if ($authentication->isUserLoggedIn()) {
			// The user is logged in
			
			// Gets the logged in user
			$loggedInUser = $authentication->getLoggedInUser();
			
			// TODO: what if $loggedInUser is null?
			
			// Defines the output
			$output = [
				'id' => $loggedInUser['id'],
				'loggedIn' => true
			];
		} else {
			// The user is not logged in
			
			// Defines the output
			$output = [
				'loggedIn' => false
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
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		// The service is available for all users
		return true;
	}

}
