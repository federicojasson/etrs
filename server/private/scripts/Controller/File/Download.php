<?php

namespace App\Controller\File;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/file/download
 * Method:	POST
 */
class Download extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$id = $this->getInput('id', 'hex2bin');
		
		// Gets the file
		$file = $this->getFile($id);
		
		// Downloads the file
		$app->files->download($file);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'id' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			})
		]);
		
		// Validates the JSON request and returns the result
		return $this->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
	/*
	 * Returns a file. If the file doesn't exist, the execution is halted.
	 * 
	 * It receives the file's ID.
	 */
	private function getFile($id) {
		$app = $this->app;
		
		// Gets the file
		$file = $app->data->file->get($id);
		
		if (is_null($file)) {
			// The file doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_FILE
			]);
		}
		
		return $file;
	}
	
}
