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

namespace App\Service\Permission\PasswordReset;

/**
 * Represents the /permission/password-reset/request service.
 */
class Request extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$credentials = $this->getInputValue('credentials');
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByEmailAddress($credentials['id'], $credentials['emailAddress']);
		
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
		
		// Gets the user
		$user = $app->data->getReference('Entity:User', $credentials['id']);
		
		// Gets the user's password-reset permission
		$passwordResetPermission = $user->getPasswordResetPermission();
		
		if (! is_null($passwordResetPermission)) {
			// Deletes the password-reset permission
			$app->data->remove($passwordResetPermission);
		}
		
		// Creates the password-reset permission
		$passwordResetPermission = new \App\Data\Entity\PasswordResetPermission();
		$passwordResetPermission->setPasswordHash($hash);
		$passwordResetPermission->setSalt($salt);
		$passwordResetPermission->setKeyStretchingIterations($keyStretchingIterations);
		$passwordResetPermission->setUser($user);
		$app->data->persist($passwordResetPermission);
		
		// Gets the password-reset permission's ID
		$id = $passwordResetPermission->getId();
		
		// Builds an email recipient
		$recipient = [
			'fullName' => $user->getFirstName() . ' ' . $user->getLastName(),
			'emailAddress' => $user->getEmailAddress()
		];
		
		// Sends a password-reset email
		$delivered = $app->email->sendPasswordReset($recipient, $id, $password);
		
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
		
		// Builds an input validator
		$inputValidator = new \App\InputValidator\Input\InputObject([
			'credentials' => new \App\InputValidator\Input\InputObject([
				'id' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				}),
				
				'emailAddress' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			])
		]);
		
		// Validates the input
		return $app->inputValidator->isInputValid($input, $inputValidator);
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
