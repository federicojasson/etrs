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
		
		// TODO: debug
		$app->halt(HTTP_STATUS_BAD_REQUEST, [
			'id' => ERROR_ID_INVALID_INPUT
		]);
		
		// Initializes the output
		$output = [];
		
		if ($authentication->isUserLoggedIn()) {
			// The user is logged in
			$loggedIn = true;
			
			// Gets the logged in user
			$loggedInUser = $authentication->getLoggedInUser();
			
			// Sets the logged in user's ID
			$output['id'] = $loggedInUser['id'];
		} else {
			// The user is not logged in
			$loggedIn = false;
		}
		
		// Sets the logged in parameter
		$output['loggedIn'] = $loggedIn;
		
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
