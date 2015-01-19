<?php

namespace App\Controllers\Authentication;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/authentication/sign-in
 *	Method:	POST
 */
class SignIn extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$id = $input['id'];
		$password = $input['password'];
		
		if ($app->authenticator->authenticateUser($id, $password)) {
			// The user was authenticated
			
			// Signs in the user in the system
			$app->authentication->signInUser($id);
			
			// Defines the output
			$output = [
				'authenticated' => true
			];
		} else {
			// The user was not authenticated
			
			// Defines the output
			$output = [
				'authenticated' => false
			];
		}
		
		// Sets the output
		$app->response->setBody($output);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement validation
				return true;
			}),
			
			'password' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement validation
				return true;
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
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ANONYMOUS
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
