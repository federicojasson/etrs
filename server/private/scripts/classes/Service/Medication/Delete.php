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
class Delete extends \App\Service\ExternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$id = $this->getInput('id', 'hex2bin');
		$version = $this->getInput('version');
		
		// Gets the current date-time
		$currentDateTime = $app->server->getCurrentDateTime();
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($id, $version, $currentDateTime) {
			global $app;
			
			// Gets the medication
			$medication = $entityManager->getRepository('App\Data\Entity\Medication')->findNonDeleted($id);
			
			// Asserts conditions
			$app->assertor->entityExists($medication);
			$app->assertor->entityVersionUpdated($medication, $version);
			
			// Deletes the medication
			$medication->setDeletionDateTime($currentDateTime);
			$medication->delete();
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
			'id' => new ValueDescriptor(function($input) {
				// TODO: implement
				return true;
			}),
			
			'version' => new ValueDescriptor(function($input) {
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
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Determines whether the user is authorized
		return $app->access->isUserAuthorized($authorizedUserRoles);
	}
	
}
