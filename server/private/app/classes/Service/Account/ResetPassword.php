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
 * Represents the /account/reset-password service.
 */
class ResetPassword extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$credentials = $this->getInputValue('credentials', createArrayFilter('hex2bin'));
		$password = $this->getInputValue('password');
		
		// Authenticates the password-reset permission
		$authenticated = $app->authenticator->authenticatePasswordResetPermissionByPassword($credentials['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutputValue('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The password-reset permission has not been authenticated
			return;
		}
		
		// Computes the password's hash
		list($hash, $salt, $keyStretchingIterations) = $app->cryptography->computeNewPasswordHash($password);
		
		// Gets the password-reset permission
		$passwordResetPermission = $app->data->getReference('Entity:PasswordResetPermission', $credentials['id']);

		// Gets the password-reset permission's user
		$user = $passwordResetPermission->getUser();

		// Edits the user
		$user->setPasswordHash($hash);
		$user->setSalt($salt);
		$user->setKeyStretchingIterations($keyStretchingIterations);
		$app->data->merge($user);

		// Deletes the password-reset permission
		$app->data->remove($passwordResetPermission);
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
				'id' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				}),
				
				'password' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomPassword($input);
				})
			]),
			
			'password' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isPassword($input);
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
		
		// Only non-signed-in users are authorized
		return ! $app->account->isUserSignedIn();
	}

}
