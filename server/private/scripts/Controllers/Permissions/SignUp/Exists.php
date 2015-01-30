<?php

namespace App\Controllers\Permissions\SignUp;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/permissions/sign-up/exists
 * Method:	POST
 */
class Exists extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// TODO: implement
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
			})
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// The service is available only for users not signed in
		return ! $app->account->isUserSignedIn();
	}
	
}
