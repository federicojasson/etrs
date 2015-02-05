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
		$password = $this->getInput('password');
		$firstName = $this->getInput('firstName', 'trimString');
		$lastName = $this->getInput('lastName', 'trimString');
		$gender = $this->getInput('gender');
		$emailAddress = $this->getInput('emailAddress');
		
		// Authenticates the sign up permission
		$authenticated = $app->authenticator->authenticateSignUpPermissionByPassword($credentials);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The sign up permission was not authenticated
			return;
		}
		
		// Checks the non-existence of the user
		$this->checkUserNonExistence($id);
		
		// Computes the hash of the password
		$salt = $app->cryptography->generateSalt();
		$keyDerivationIterations = $app->parameters->cryptography['keyDerivationIterations'];
		$passwordHash = $app->cryptography->hashPassword($password, $salt, $keyDerivationIterations);
		
		// Signs up the user in the system
		$app->authentication->signUpUser($id, $passwordHash, $salt, $keyDerivationIterations, $role, $firstName, $lastName, $gender, $emailAddress); // TODO: get parameters
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
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
	 * Checks the non-existence of a user. If it exists, the execution is
	 * halted.
	 * 
	 * It receives the user's ID.
	 */
	private function checkUserNonExistence($id) {
		$app = $this->app;
		
		if ($app->data->user->exists($id)) {
			// The user exists
			
			// Halts the execution
			$app->halt(HTTP_STATUS_CONFLICT, [
				'error' => ERROR_ALREADY_EXISTING_USER
			]);
		}
	}
	
}
