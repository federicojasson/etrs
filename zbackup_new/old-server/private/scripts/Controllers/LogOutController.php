<?php

/*
 * This controller implements the following service:
 * 
 *	URL:	/server/log-out
 *	Method:	POST
 */
class LogOutController extends SecureController {
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		parent::__construct([
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
		// Clears the session key
		$this->app->session->clear(SESSION_KEY_LOGGED_IN_USER_ID);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
}
