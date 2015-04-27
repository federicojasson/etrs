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
 * Represents the /file/upload service.
 */
class Upload extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$name = $this->getInputValue('name', 'buildFileName');
		$temporaryPath = $this->getInputValue('temporaryPath');
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Computes the file's hash
		$hash = $app->cryptography->computeFileHash($temporaryPath);
		
		// Creates the file
		$file = new \App\Data\Entity\File();
		$file->setHash($hash);
		$file->setName($name);
		$file->setCreator($user);
		$app->data->persist($file);
		
		// Gets the file's ID
		$id = $file->getId();
		
		// Sets an output
		$this->setOutputValue('id', $id, 'bin2hex');
		
		// Uploads the file
		$app->file->upload($id, $temporaryPath);
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		global $app;
		
		if (! $this->isFormDataRequest()) {
			// It is not a form-data request
			return false;
		}
		
		// Gets inputs
		$name = $this->getInputValue('name');
		
		if (! $app->inputValidator->isValidString($name, 0, 128)) {
			// The name is invalid
			return false;
		}
		
		return true;
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_OPERATOR
		]);
	}

}
