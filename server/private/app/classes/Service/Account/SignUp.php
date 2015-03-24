<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Service\Account;

/**
 * Represents the /account/sign-up service.
 */
class SignUp extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets the inputs
		$credentials = $this->getInputValue('credentials', createArrayFilter('hex2bin'));
		$id = $this->getInputValue('id');
		$emailAddress = $this->getInputValue('emailAddress');
		$password = $this->getInputValue('password');
		$firstName = $this->getInputValue('firstName', 'trimAndShrink');
		$lastName = $this->getInputValue('lastName', 'trimAndShrink');
		$gender = $this->getInputValue('gender');
		
		// Authenticates the sign-up permission
		$authenticated = $app->authenticator->authenticateSignUpPermissionByPassword($credentials['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutputValue('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The sign-up permission has not been authenticated
			return;
		}
		
		// Determines whether the user ID is available
		$available = is_null($app->data->getRepository('App\Data\Entity\User')->find($id));
		
		// Sets an output
		$this->setOutputValue('available', $available);
		
		if (! $available) {
			// The user ID is not available
			return;
		}
		
		// Computes the password's hash
		list($hash, $salt, $keyStretchingIterations) = $app->cryptography->computeNewPasswordHash($password);
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($credentials, $id, $emailAddress, $hash, $salt, $keyStretchingIterations, $firstName, $lastName, $gender) {
			// Gets the sign-up permission
			$signUpPermission = $entityManager->getReference('App\Data\Entity\SignUpPermission', $credentials['id']);
			
			// Initializes the user
			$user = new \App\Data\Entity\User();
			
			// Creates the user
			$user->setId($id);
			$user->setRole($signUpPermission->getUserRole());
			$user->setEmailAddress($emailAddress);
			$user->setPasswordHash($hash);
			$user->setSalt($salt);
			$user->setKeyStretchingIterations($keyStretchingIterations);
			$user->setFirstName($firstName);
			$user->setLastName($lastName);
			$user->setGender($gender);
			$user->setCreator($signUpPermission->getCreator());
			$entityManager->persist($user);
			
			// Deletes the sign-up permission
			$entityManager->remove($signUpPermission);
		});
		
		// Builds an email recipient
		$recipient = [
			'fullName' => $firstName . ' ' . $lastName,
			'emailAddress' => $emailAddress
		];
		
		// Sends a welcome email
		$app->email->sendWelcome($recipient);
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		global $app;
		
		if (! $this->isJsonRequest()) {
			// It is not a JSON request
			return false;
		}
		
		// Builds a JSON input validator
		$jsonInputValidator = new \App\InputValidator\Json\JsonObject([
			'credentials' => new \App\InputValidator\Json\JsonObject([
				'id' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				}),
				
				'password' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomPassword($input);
				})
			]),
			
			'id' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isUserId($input);
			}),
			
			'emailAddress' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isEmailAddress($input);
			}),
			
			'password' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidPassword($input);
			}),
			
			'firstName' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidLine($input, 1, 48);
			}),
			
			'lastName' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidLine($input, 1, 48);
			}),
			
			'gender' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isGender($input);
			})
		]);
		
		// Gets the input
		$input = $this->getInput();
		
		// Validates the input
		return $app->inputValidator->isJsonInputValid($input, $jsonInputValidator);
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Only non-signed-in users are authorized
		return ! $app->account->isUserSignedIn();
	}

}
