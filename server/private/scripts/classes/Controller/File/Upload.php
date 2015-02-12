<?php

namespace App\Controller\File;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/file/upload
 * Method:	POST
 */
class Upload extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$name = $this->getInput('name'); // TODO: process name?
		$temporaryPath = $this->getInput('temporaryPath');
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Uploads the file
		$hash = $app->files->upload($id, $name, $temporaryPath);
		
		// Creates the file
		$app->data->file->create($id, $signedInUser['id'], $name, $hash);
		
		// Sets an output
		$this->setOutput('id', $id, 'bin2hex');
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// Validates the form data request and returns the result
		return $this->validateFormDataRequest('file');
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
