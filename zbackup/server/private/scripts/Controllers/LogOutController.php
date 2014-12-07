<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/log-out
 *	Method:	POST
 */
class LogOutController extends SecureController {
	
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
		// There is no input
		return true;
	}
	
}
