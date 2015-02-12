<?php

namespace App\Controller\Experiment;

use App\Auxiliar\JsonStructureDescriptor\JsonArrayDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/experiment/create
 * Method:	POST
 */
class Create extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$name = $this->getInput('name', 'trimString');
		$commandLine = $this->getInput('commandLine', 'trimString');
		$files = $this->getInput('files', 'stringsToBinary');
		
		// Checks the existence of the files
		$this->checkFilesExistence($files);
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Creates the experiment
		$app->data->experiment->create($id, $signedInUser['id'], $name, $commandLine, $files);
		
		// Sets an output
		$this->setOutput('id', $id, 'bin2hex');
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'name' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 1, 128);
			}),
			
			'commandLine' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isCommandLine($input);
			}),
			
			'files' => new JsonArrayDescriptor(
				new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		if (! $this->validateJsonRequest($jsonStructureDescriptor)) {
			// The JSON request is invalid
			return false;
		}
		
		// Gets the input
		$files = $this->getInput('files', 'stringsToBinary');
		
		if (! $this->areFilesValid($files)) {
			// The files are invalid
			return false;
		}
		
		return true;
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
