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

namespace App\Service\Medicine;

/**
 * Represents the /medicine/delete service.
 */
class Delete extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets the inputs
		$id = $this->getInputValue('id', 'hex2bin');
		$version = $this->getInputValue('version');
		
		// Gets the signed-in user
		$signedInUser = $app->account->getSignedInUser();
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($app, $id, $version, $signedInUser) {
			// Gets the medicine
			$medicine = $entityManager->getRepository('Entity:Medicine')->findNonDeleted($id);
			
			// Asserts conditions
			$app->assertion->entityExists($medicine);
			$app->assertion->entityUpdated($medicine, $version);
			
			// Deletes the medicine
			$medicine->delete($signedInUser);
		});
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
		
		// Builds a JSON input validator
		$jsonInputValidator = new \App\InputValidator\Json\JsonObject([
			'id' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'version' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidInteger($input, 0);
			})
		]);
		
		// Gets the input
		$input = $this->getInput();
		
		// Validates the input
		return $app->inputValidator->isJsonInputValid($input, $jsonInputValidator);
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR
		]);
	}

}
