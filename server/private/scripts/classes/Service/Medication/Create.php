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

namespace App\Service\Medication;

use App\Utility\JsonDescriptor\ObjectDescriptor;
use App\Utility\JsonDescriptor\ValueDescriptor;

/**
 * TODO: comment
 */
class Create extends \App\Service\ExternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$name = $this->getInput('name', 'trimAndShrink');
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Gets the current date-time
		$currentDateTime = $app->server->getCurrentDateTime();
		
		// Gets the signed-in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($id, $currentDateTime, $name, $signedInUser) {
			// Initializes the medication
			$medication = new \App\Data\Entity\Medication();
			
			// Creates the medication
			$medication->setId($id);
			$medication->setCreationDateTime($currentDateTime);
			$medication->setName($name);
			$medication->setCreator($signedInUser);
			$entityManager->persist($medication);
		});
		
		// Sets an output
		$this->setOutput('id', $id, 'bin2hex');
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
			'name' => new ValueDescriptor(function($input) {
				// TODO: implement
				return true;
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
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Determines whether the user is authorized
		return $app->access->isUserAuthorized($authorizedUserRoles);
	}
	
}
