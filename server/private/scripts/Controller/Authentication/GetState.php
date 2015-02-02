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
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		// The service is available to all users
		return true;
	}
	
}
