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

namespace App\Service\Permission\SignUp;

/**
 * Represents the /permission/sign-up/request service.
 */
class Request extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$credentials = $this->getInputValue('credentials');
		$recipient = $this->getInputValue('recipient');
		$recipient['fullName'] = trimAndShrink($recipient['fullName']);
		$userRole = $this->getInputValue('userRole');
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByPassword($user->getId(), $credentials['password']);
		
		// Sets an output
		$this->setOutputValue('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The user has not been authenticated
			return;
		}
		
		// Generates a random password
		$password = $app->cryptography->generateRandomPassword();
		
		// Computes the password's hash
		list($hash, $salt, $keyStretchingIterations) = $app->cryptography->computeNewPasswordHash($password);
		
		// Gets the sign-up permission associated with the email address
		$signUpPermissions = $app->data->getRepository('Entity:SignUpPermission')->findBy([
			'emailAddress' => $recipient['emailAddress']
		], null, 1);
		
		if (count($signUpPermissions) > 0) {
			// A sign-up permission has been found
			
			// Gets the sign-up permission
			$signUpPermission = $signUpPermissions[0];
			
			// Deletes the sign-up permission
			$app->data->remove($signUpPermission);
		}
		
		// Creates the sign-up permission
		$signUpPermission = new \App\Data\Entity\SignUpPermission();
		$signUpPermission->setPasswordHash($hash);
		$signUpPermission->setSalt($salt);
		$signUpPermission->setKeyStretchingIterations($keyStretchingIterations);
		$signUpPermission->setUserRole($userRole);
		$signUpPermission->setEmailAddress($recipient['emailAddress']);
		$signUpPermission->setCreator($user);
		$app->data->persist($signUpPermission);
		
		// Gets the sign-up permission's ID
		$id = $signUpPermission->getId();
		
		// Sends a sign-up email
		$delivered = $app->email->sendSignUp($recipient, $id, $password);
		
		// Asserts conditions
		$app->assertion->emailDelivered($delivered);
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
		
		// Gets the input
		$input = $this->getInput();
		
		// Builds a JSON input validator
		$jsonInputValidator = new \App\InputValidator\Json\JsonObject([
			'credentials' => new \App\InputValidator\Json\JsonObject([
				'password' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			]),
			
			'recipient' => new \App\InputValidator\Json\JsonObject([
				'fullName' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isValidLine($input, 0, 97);
				}),
				
				'emailAddress' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isEmailAddress($input);
				})
			]),
			
			'userRole' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isUserRole($input);
			})
		]);
		
		// Validates the input
		return $app->inputValidator->isJsonInputValid($input, $jsonInputValidator);
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR
		]);
	}

}
