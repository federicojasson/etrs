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

use App\Utility\JsonDescriptor\ObjectDescriptor;
use App\Utility\JsonDescriptor\ValueDescriptor;

/**
 * TODO: comment
 */
class ResetPassword extends \App\Service\ExternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$credentials = $this->getInput('credentials', 'stringsToBinary');
		$password = $this->getInput('password');
		
		// Authenticates the reset-password permission
		$authenticated = $app->authenticator->authenticateResetPasswordPermissionByPassword($credentials['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The reset-password permission has not been authenticated
			return;
		}
		
		// Computes the hash of the password
		list($passwordHash, $salt, $keyStretchingIterations) = $app->cryptography->hashNewPassword($password);
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($app, $credentials, $passwordHash, $salt, $keyStretchingIterations) {
			// Gets the reset-password permission
			$resetPasswordPermission = $entityManager->getReference('App\Data\Entity\ResetPasswordPermission', $credentials['id']);
			
			// Gets the user
			$user = $resetPasswordPermission->getUser();
			
			// Asserts conditions
			$app->assertor->entityExists($user);
			
			// Edits the user
			$user->setLastEditionDateTime();
			$user->setPasswordHash($passwordHash);
			$user->setSalt($salt);
			$user->setKeyStretchingIterations($keyStretchingIterations);
			
			// Deletes the reset-password permission
			$entityManager->remove($resetPasswordPermission);
		});
	}
	
	/**
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		global $app;
		
		if (! $this->isJsonRequest()) {
			// It is not a JSON request
			return false;
		}
		
		// Defines a JSON descriptor
		$jsonDescriptor = new ObjectDescriptor([
			'credentials' => new ObjectDescriptor([
				'id' => new ValueDescriptor(function($input) {
					// TODO: implement
					return true;
				}),
				
				'password' => new ValueDescriptor(function($input) {
					// TODO: implement
					return true;
				})
			]),
			
			'password' => new ValueDescriptor(function($input) {
				// TODO: implement
				return true;
			})
		]);
		
		// Gets the input
		$input = $this->getCompleteInput();
		
		// Determines whether the input is valid
		return $app->inputValidator->isJsonInputValid($input, $jsonDescriptor);
	}
	
	/**
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// The service is available only to non-signed-in users
		return ! $app->authentication->isUserSignedIn();
	}
	
}
