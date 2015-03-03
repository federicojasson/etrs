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
		
		// Gets the input
		$credentials = $this->getInput('credentials');
		$recipient = $this->getInput('recipient');
		$userRole = $this->getInput('userRole');
		
		// Gets the signed-in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByPassword($signedInUser->getId(), $credentials['password']);
		
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
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($id, $currentDateTime, $passwordHash, $salt, $keyStretchingIterations, $userRole, $signedInUser) {
			// Initializes the sign-up permission
			$signUpPermission = new \App\Data\Entity\SignUpPermission();
			
			// Creates the sign-up permission
			$signUpPermission->setId($id);
			$signUpPermission->setCreationDateTime($currentDateTime);
			$signUpPermission->setPasswordHash($passwordHash);
			$signUpPermission->setSalt($salt);
			$signUpPermission->setKeyStretchingIterations($keyStretchingIterations);
			$signUpPermission->setUserRole($userRole);
			$signUpPermission->setCreator($signedInUser);
			$entityManager->persist($signUpPermission);
		});
		
		// Sends a sign-up email
		$app->emails->sendSignUpEmail($recipient, $id, $password);
	}
	
	/**
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		global $app;
		
		if (! $app->request->isJsonRequest()) {
			// It is not a JSON request
			return false;
		}
		
		// Defines the JSON descriptor
		$jsonDescriptor = new ObjectDescriptor([
			'credentials' => new ObjectDescriptor([
				'password' => new ValueDescriptor(function($input) {
					// TODO: implement
					return true;
				})
			]),
			
			'recipient' => new ObjectDescriptor([
				'name' => new ValueDescriptor(function($input) {
					// TODO: implement
					return true;
				}),
				
				'emailAddress' => new ValueDescriptor(function($input) {
					// TODO: implement
					return true;
				})
			]),
			
			'userRole' => new ValueDescriptor(function($input) {
				// TODO: implement
				return true;
			})
		]);
		
		// Determines whether the JSON input is valid
		return $this->isJsonInputValid($jsonDescriptor);
	}
	
	/**
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Determines whether the user is authorized
		return $app->access->isUserAuthorized($authorizedUserRoles);
	}
	
}