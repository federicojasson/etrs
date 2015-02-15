<?php

namespace App\Controller\Study;

use App\Auxiliar\JsonStructureDescriptor\JsonArrayDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/study/create
 * Method:	POST
 */
class Create extends \App\Controller\SpecializedExternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$consultation = $this->getInput('consultation', 'hex2bin');
		$experiment = $this->getInput('experiment', 'hex2bin');
		$input = $this->getInput('input', 'hex2bin');
		$observations = $this->getInput('observations', 'trimString');
		$files = $this->getInput('files', 'stringsToBinary');
		
		// Checks the existence of the consultation
		$this->checkConsultationExistence($consultation);
		
		// Checks the existence of the experiment
		$this->checkExperimentExistence($experiment);
		
		// Checks the existence of the input
		$this->checkFileExistence($input);
		
		// Checks the existence of the files
		$this->checkFilesExistence($files);
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Creates the study
		$app->data->study->create($id, $consultation, $signedInUser['id'], $experiment, $input, $observations, $files);
		
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
			'consultation' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'experiment' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'input' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'observations' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 0, 1024);
			}),
			
			'files' => new JsonArrayDescriptor(
				new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		if (! $this->validateJsonInput($jsonStructureDescriptor)) {
			// The JSON input is invalid
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
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
