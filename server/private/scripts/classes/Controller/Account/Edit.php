<?php

namespace App\Controller\Account;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/account/edit
 * Method:	POST
 */
class Edit extends \App\Controller\SpecializedExternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$credentials = $this->getInput('credentials');
		$password = $this->getInput('password');
		$firstName = $this->getInput('firstName', 'trimString');
		$lastName = $this->getInput('lastName', 'trimString');
		$gender = $this->getInput('gender');
		$emailAddress = $this->getInput('emailAddress');
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByPassword($signedInUser['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The user was not authenticated
			return;
		}
		
		// Computes the hash of the password
		list($passwordHash, $salt, $keyStretchingIterations) = $app->cryptography->hashNewPassword($password);
		
		// Edits the user
		$app->data->user->edit($signedInUser['id'], $passwordHash, $salt, $keyStretchingIterations, $firstName, $lastName, $gender, $emailAddress);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'credentials' => new JsonObjectDescriptor([
				'password' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			]),
			
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
		
		// Validates the JSON input and returns the result
		return $this->validateJsonInput($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// The service is available only to signed in users
		return $app->authentication->isUserSignedIn();
	}
	
}
