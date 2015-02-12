<?php

namespace App\Controller\Study;

use App\Auxiliar\JsonStructureDescriptor\JsonArrayDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/study/edit
 * Method:	POST
 */
class Edit extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$id = $this->getInput('id', 'hex2bin');
		$observations = $this->getInput('observations', 'trimString');
		$files = $this->getInput('files', 'stringsToBinary');
		
		// Gets the study
		$study = $this->getStudy($id);
		
		// Checks the existence of the files
		$this->checkFilesExistence($files);
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Edits the study
		$app->data->study->edit($id, $signedInUser['id'], $study['output'], $observations, $files);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'id' => new JsonValueDescriptor(function($input) use ($app) {
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
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
