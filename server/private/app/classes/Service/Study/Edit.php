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

namespace App\Service\Study;

/**
 * Represents the /study/edit service.
 */
class Edit extends CreateEdit {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$id = $this->getInputValue('id', 'hex2bin');
		$version = $this->getInputValue('version');
		$comments = $this->getInputValue('comments');
		$files = $this->getInputValue('files', createArrayFilter('hex2bin'));
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Gets the study
		$study = $app->data->getRepository('Entity:Study')->findNonDeleted($id);
		
		// Asserts conditions
		$app->assertion->entityExists($study);
		$app->assertion->entityUpdated($study, $version);
		
		// Edits the study
		$study->setLastEditionDateTime();
		$study->setComments($comments);
		$study->setLastEditor($user);
		$app->data->merge($study);
		
		// Sets the associated entities
		$this->setStudyFiles($study, $files);
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
		
		// Builds an input validator
		$inputValidator = new \App\InputValidator\Input\InputObject([
			'id' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'version' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidInteger($input, 0);
			}),
			
			'comments' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidString($input, 0, 1024);
			}),
			
			'files' => new \App\InputValidator\Input\InputArray(
				new \App\InputValidator\Input\InputValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		if (! $app->inputValidator->isInputValid($input, $inputValidator)) {
			// The input is invalid
			return false;
		}
		
		// Gets inputs
		$files = $this->getInputValue('files', createArrayFilter('hex2bin'));
		
		if (arrayContainsDuplicates($files)) {
			// The files are invalid
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
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		]);
	}

}
