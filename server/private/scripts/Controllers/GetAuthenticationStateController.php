<?php

/*
 * This controller implements the following service:
 * 
 *	URL:	/server/get-authentication-state
 *	Method:	POST
 */
class GetAuthenticationStateController extends SecureController {
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		parent::__construct([
			USER_ROLE_ANONYMOUS,
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR,
			USER_ROLE_RESEARCHER
		]);
	}
	
	/*
	 * Executes the controller's logic.
	 */
	protected function executeLogic() {
		$app = $this->app;
		$authenticator = $app->authenticator;
		$response = $app->response;
		
		// Initializes the output
		$output = [];
		
		// Determines whether the user is logged in
		$loggedIn = $authenticator->isUserLoggedIn();
		
		// Updates the output
		$output['loggedIn'] = $loggedIn;
		
		if ($loggedIn) {
			// The user is logged in
			
			// Gets the user's ID
			$userId = $authenticator->getLoggedInUserId();
			
			// Updates the output
			$output['user'] = [
				'data' => [
					'id' => $userId
				]
			];
		}
		
		// Sets the response body
		$response->setBody($output);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
}
