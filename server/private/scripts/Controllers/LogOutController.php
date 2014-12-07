<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/log-out
 *	Method:	POST
 */
class LogOutController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		// TODO: implement
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
		// TODO: implement
	}

}
