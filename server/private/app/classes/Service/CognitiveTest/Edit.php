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

namespace App\Service\CognitiveTest;

/**
 * Represents the /cognitive-test/edit service.
 */
class Edit extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$id = $this->getInputValue('id', 'hex2bin');
		$version = $this->getInputValue('version');
		$dataTypeDefinition = $this->getInputValue('dataTypeDefinition', 'trimAndShrink');
		$name = $this->getInputValue('name', 'trimAndShrink');
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Gets the cognitive test
		$cognitiveTest = $app->data->getRepository('Entity:CognitiveTest')->findNonDeleted($id);
		
		// Asserts conditions
		$app->assertion->entityExists($cognitiveTest);
		$app->assertion->entityUpdated($cognitiveTest, $version);
		
		// Edits the cognitive test
		$cognitiveTest->setLastEditionDateTime();
		$cognitiveTest->setDataTypeDefinition($dataTypeDefinition);
		$cognitiveTest->setName($name);
		$cognitiveTest->setLastEditor($user);
		$app->data->merge($cognitiveTest);
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
			
			'dataTypeDefinition' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isDataTypeDefinition($input);
			}),
			
			'name' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidLine($input, 1, 64);
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
			USER_ROLE_ADMINISTRATOR
		]);
	}

}
