<?php

namespace App\Controllers\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/edit
 * Method:	POST
 */
class Edit extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// TODO: transactions?
		
		// Gets the input
		$input = $app->request->getBody();
		$password = $input['password'];
		$firstName = trimString($input['firstName']);
		$lastName = trimString($input['lastName']);
		$gender = $input['gender'];
		$emailAddress = $input['emailAddress'];
		
		// Gets the signed in user
		$signedInUser = $app->account->getSignedInUser();
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByPassword($signedInUser['id'], $password);
		
		if ($authenticated) {
			// The user was authenticated
			
			// Edits the user
			$app->webServerDatabase->editUser(
				$signedInUser['id'],
				$signedInUser['passwordHash'],
				$signedInUser['salt'],
				$signedInUser['keyDerivationIterations'],
				$signedInUser['role'],
				$firstName,
				$lastName,
				$gender,
				$emailAddress
			);
		}
		
		// Sets the output
		$app->response->setBody([
			'authenticated' => $authenticated
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'password' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
			}),
			
			'firstName' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
			}),
			
			'lastName' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
			}),
			
			'gender' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
			}),
			
			'emailAddress' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
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
		
		// The service is available only for signed in users
		return $app->account->isUserSignedIn();
	}
	
}
