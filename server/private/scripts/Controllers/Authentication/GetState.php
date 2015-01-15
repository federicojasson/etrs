<?php

namespace App\Controllers\Authentication;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/authentication/get-state
 *	Method:	POST
 */
class GetState extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		// TODO: Controllers/Authentication/GetState.php
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
