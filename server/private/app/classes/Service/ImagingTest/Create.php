<?php

/**
 * NEU-CO - Neuro-Cognitivo
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

namespace App\Service\ImagingTest;

/**
 * Represents the /imaging-test/create service.
 */
class Create extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$dataTypeDefinition = $this->getInputValue('dataTypeDefinition', 'trimAndShrink');
		$name = $this->getInputValue('name', 'trimAndShrink');
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Creates the imaging test
		$imagingTest = new \App\Data\Entity\ImagingTest();
		$imagingTest->setDataTypeDefinition($dataTypeDefinition);
		$imagingTest->setName($name);
		$imagingTest->setCreator($user);
		$app->data->persist($imagingTest);
		
		// Gets the imaging test's ID
		$id = $imagingTest->getId();
		
		// Sets an output
		$this->setOutputValue('id', $id, 'bin2hex');
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
