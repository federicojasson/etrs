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
class SignUp extends \App\Service\ExternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		// TODO: process input?
		$credentials = $this->getInput('credentials', 'stringsToBinary');
		$id = $this->getInput('id');
		$emailAddress = $this->getInput('emailAddress');
		$password = $this->getInput('password');
		$firstName = $this->getInput('firstName');
		$lastName = $this->getInput('lastName');
		$gender = $this->getInput('gender');
		
		// Authenticates the sign-up permission
		$authenticated = $app->authenticator->authenticateSignUpPermissionByPassword($credentials['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The sign-up permission has not been authenticated
			return;
		}
		
		// Computes the hash of the password
		list($passwordHash, $salt, $keyStretchingIterations) = $app->cryptography->hashNewPassword($password);
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($app, $credentials, $id, $emailAddress, $passwordHash, $salt, $keyStretchingIterations, $firstName, $lastName, $gender) {
			// Gets the sign-up permission
			$signUpPermission = $entityManager->getReference('App\Data\Entity\SignUpPermission', $credentials['id']);
			
			// Gets the user
			$user = $entityManager->getRepository('App\Data\Entity\User')->find($id);
			
			// Asserts conditions
			$app->assertor->entityDoesNotExist($user);
			
			// Initializes the user
			$user = new \App\Data\Entity\User();
			
			// Creates the user
			$user->setId($id);
			$user->setRole($signUpPermission->getUserRole());
			$user->setEmailAddress($emailAddress);
			$user->setPasswordHash($passwordHash);
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
				'id' => new ValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				}),
				
				'password' => new ValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isRandomPassword($input);
				})
			]),
			
			'id' => new ValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isUserId($input);
			}),
			
			'emailAddress' => new ValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isEmailAddress($input);
			}),
			
			'password' => new ValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidPassword($input);
			}),
			
			'firstName' => new ValueDescriptor(function($input) {
				// TODO: implement
				return true;
			}),
			
			'lastName' => new ValueDescriptor(function($input) {
				// TODO: implement
				return true;
			}),
			
			'gender' => new ValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isGender($input);
			})
		]);
		
		// Gets the input
		$input = $this->getCompleteInput();
		
		// Determines whether the JSON input is valid
		return $app->inputValidator->isValidJsonInput($input, $jsonDescriptor);
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
