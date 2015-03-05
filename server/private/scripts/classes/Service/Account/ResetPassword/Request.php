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

namespace App\Service\Account\ResetPassword;

use App\Utility\JsonDescriptor\ObjectDescriptor;
use App\Utility\JsonDescriptor\ValueDescriptor;

/**
 * TODO: comment
 */
class Request extends \App\Service\ExternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$credentials = $this->getInput('credentials');
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByEmailAddress($credentials['id'], $credentials['emailAddress']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The user has not been authenticated
			return;
		}
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Gets the current date-time
		$currentDateTime = $app->server->getCurrentDateTime();
		
		// Generates a random password
		$password = $app->cryptography->generateRandomPassword();
		
		// Computes the hash of the password
		list($passwordHash, $salt, $keyStretchingIterations) = $app->cryptography->hashNewPassword($password);
		
		// Gets the user
		$user = $app->data->getReference('App\Data\Entity\User', $credentials['id']);
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($id, $currentDateTime, $passwordHash, $salt, $keyStretchingIterations, $user) {
			// Deletes the reset-password permissions associated with the user
			$entityManager->createQueryBuilder()
				->delete('App\Data\Entity\ResetPasswordPermission', 'resetPasswordPermission')
				->where('resetPasswordPermission.user = :user')
				->setParameter('user', $user)
				->setMaxResults(1)
				->getQuery()
				->getResult();
			
			// Initializes the reset-password permission
			$resetPasswordPermission = new \App\Data\Entity\ResetPasswordPermission();
			
			// Creates the reset-password permission
			$resetPasswordPermission->setId($id);
			$resetPasswordPermission->setCreationDateTime($currentDateTime);
			$resetPasswordPermission->setPasswordHash($passwordHash);
			$resetPasswordPermission->setSalt($salt);
			$resetPasswordPermission->setKeyStretchingIterations($keyStretchingIterations);
			$resetPasswordPermission->setUser($user);
			$entityManager->persist($resetPasswordPermission);
		});
		
		// Initializes the recipient of the email
		$recipient = [
			'name' => $user->getFirstName() . ' ' . $user->getLastName(),
			'emailAddress' => $user->getEmailAddress()
		];
		
		// Sends a reset-password email
		$app->emails->sendResetPasswordEmail($recipient, $id, $password);
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
				
				'emailAddress' => new ValueDescriptor(function($input) {
					// TODO: implement
					return true;
				})
			])
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
