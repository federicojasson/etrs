<?php

namespace App\Controller\Account;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/account/sign-up
 * Method:	POST
 */
class SignUp extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$credentials = $this->getInput('credentials');
		$id = $this->getInput('id');
		// TODO: get other input
		
		// Authenticates the sign up permission
		$authenticated = $app->authenticator->authenticateSignUpPermissionByPassword($credentials);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The sign up permission was not authenticated
			return;
		}
		
		// Starts a read-write transaction
		$app->webServerDatabase->startReadWriteTransaction();
		
		// Checks the non-existence of the user
		$this->checkUserNonExistence($id);
		
		// TODO: implement sign up ---> use Data helper and Model?
		
		// Commits the transaction
		$app->webServerDatabase->commitTransaction();
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'credentials' => new JsonObjectDescriptor([
				'id' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				}),
				
				'password' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			]),
			
			'id' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isUserId($input);
			}),
			
			'password' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidPassword($input);
			}),
			
			'firstName' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 1, 48);
			}),
			
			'lastName' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 1, 48);
			}),
			
			'gender' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isGender($input);
			}),
			
			'emailAddress' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isEmailAddress($input);
			})
		]);
		
		// Validates the JSON request and returns the result
		return $this->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// The service is available only to users not signed in
		return ! $app->authentication->isUserSignedIn();
	}
	
	/*
	 * TODO: comments
	 */
	private function checkUserNonExistence($id) {
		// TODO: implement
	}
	
}
