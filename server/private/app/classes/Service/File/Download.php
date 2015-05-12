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
 * Represents the /file/download service.
 */
class Download extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$id = $this->getInputValue('id', 'hex2bin');
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Gets the file
		$file = $app->data->getRepository('Entity:File')->findNonDeleted($id);

		// Asserts conditions
		$app->assertion->entityExists($file);
		
		if ($user->getRole() !== USER_ROLE_ADMINISTRATOR) {
			// The user is not an administrator
			if (count($file->getExperiments()) > 0) {
				// The file is associated with an experiment
				// Halts the application
				haltApp(HTTP_STATUS_FORBIDDEN, ERROR_CODE_UNAUTHORIZED_USER);
			}
		}
		
		// Downloads the file
		$app->file->download($file->getId(), $file->getHash(), $file->getName());
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		global $app;
		
		if (! $this->isXWwwFormUrlencodedRequest()) {
			// It is not an x-www-form-urlencoded request
			return false;
		}
		
		// Gets the input
		$input = $this->getInput();
		
		// Builds an input validator
		$inputValidator = new \App\InputValidator\Input\InputObject([
			'id' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			})
		]);
		
		// Validates the input
		return $app->inputValidator->isInputValid($input, $inputValidator);
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		]);
	}

}
