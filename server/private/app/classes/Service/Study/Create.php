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
 * Represents the /study/create service.
 */
class Create extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$comments = $this->getInputValue('comments');
		$consultation = $this->getInputValue('consultation', 'hex2bin');
		$experiment = $this->getInputValue('experiment', 'hex2bin');
		$input = $this->getInputValue('input', 'hex2bin');
		$files = $this->getInputValue('files', createArrayFilter('hex2bin'));
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Gets the consultation
		$consultation = $app->data->getRepository('Entity:Consultation')->findNonDeleted($consultation);
		
		// Gets the experiment
		$experiment = $app->data->getRepository('Entity:Experiment')->findNonDeleted($experiment);
		
		// Gets the TODO: comment
		$input = $app->data->getRepository('Entity:File')->findNonDeleted($input);
		
		// Asserts conditions
		$app->assertion->entityExists($consultation);
		$app->assertion->entityExists($experiment);
		$app->assertion->entityExists($input);
		
		// Creates the study
		$study = new \App\Data\Entity\Study();
		$study->setCommens($comments);
		$study->setCreator($user);
		$study->setConsultation($consultation);
		$study->setExperiment($experiment);
		$study->setInput($input);
		$app->data->persist($study);
		
		// Gets the study's ID
		$id = $study->getId();
		
		// Sets an output
		$this->setOutputValue('id', $id, 'bin2hex');
		
		// TODO: check existence and add associations
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
		
		// Builds a JSON input validator
		$jsonInputValidator = new \App\InputValidator\Json\JsonObject([
			'comments' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidString($input, 0, 1024);
			}),
			
			'consultation' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'experiment' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'input' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'files' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		if (! $app->inputValidator->isJsonInputValid($input, $jsonInputValidator)) {
			// The input is invalid
			return false;
		}
		
		// Gets inputs
		$files = $this->getInputValue('files', createArrayFilter('hex2bin'));
		
		if (containsDuplicates($files)) {
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
			USER_ROLE_OPERATOR
		]);
	}

}
