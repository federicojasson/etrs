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

namespace App\Service\File;

/**
 * TODO: comment
 */
class Upload extends \App\Service\ExternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets the input
		$name = $this->getInput('name');
		$path = $this->getInput('path');
		
		// Gets the current date-time
		$currentDateTime = $app->server->getCurrentDateTime();
		
		// Uploads the file
		$hash = $app->files->upload(); // TODO: implement
		
		// Gets the signed-in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Executes a transaction
		$id = $app->data->transactional(function($entityManager) use ($currentDateTime, $hash, $name, $signedInUser) {
			// Initializes the file
			$file = new \App\Data\Entity\File();
			
			// Creates the file
			$file->setCreationDateTime($currentDateTime);
			$file->setHash($hash);
			$file->setName($name);
			$file->setCreator($signedInUser);
			$entityManager->persist($file);
			
			// Returns the file's ID
			return $file->getId();
		});
		
		// Sets an output
		$this->setOutput('id', $id, 'bin2hex');
	}
	
	/**
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		global $app;
		
		if (! $app->request->isDataRequest()) {
			// It is not a data request
			return false;
		}
		
		// Validates the data input
		return $this->isDataInputValid();
	}
	
	/**
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the access
		return $app->accessValidator->isAccessValid($authorizedUserRoles);
	}
	
}
