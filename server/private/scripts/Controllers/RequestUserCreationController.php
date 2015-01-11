<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/request-user-creation
 *	Method:	POST
 */
class RequestUserCreationController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		$cryptography = $app->cryptography;
		$webServerDatabase = $app->webServerDatabase;
		
		// Gets the input
		$input = $app->request->getBody();
		$userAllegedPassword = $input['password'];
		$emailAddress = $input['emailAddress'];
		$role = $input['role'];
		
		// Gets the logged in user's ID
		$userId = $app->authentication->getLoggedInUser()['id'];
		
		if (! $app->authenticator->authenticateUser($userId, $userAllegedPassword)) {
			// The user was not authenticated
			$this->rejectRequest();
		}
		
		// Starts a transaction
		$webServerDatabase->startTransaction();
		
		// Generate a random ID
		do {
			$id = $cryptography->generateRandomId();
		} while ($webServerDatabase->userCreationRequestExists($id));
		
		// Generates a random password
		$password = $cryptography->generateRandomPassword();
		
		// Computes the hash of the password
		$passwordSalt = $cryptography->generatePasswordSalt();
		$passwordIterations = PASSWORD_ITERATIONS;
		$passwordHash = $cryptography->hashPassword($password, $passwordSalt, $passwordIterations);
		
		// Inserts the user creation request
		$webServerDatabase->insertUserCreationRequest($id, $passwordHash, $passwordSalt, $passwordIterations, $emailAddress, $role);
		
		// Commits the transaction
		$webServerDatabase->commitTransaction();
		
		// Gets the email configuration
		$configuration = $app->configurations->get('email');
		$webServerEmailAddress = $configuration['webServerEmailAddress'];
		$templateFilePath = $configuration['userCreationEmail']['templateFilePath'];
		
		// Builds the email message
		$emailMessage = $this->buildEmailMessage($templateFilePath, $password);
		
		// Sends an email with a link for user creation
		$app->emailBuilder
		->newEmail()
		->from($webServerEmailAddress)
		->to($emailAddress)
		->subject('ETRS - Creación de usuario')
		->message($emailMessage)
		->build()
		->send();
		
		// Sets the output
		$app->response->setBody([
			'requestAccepted' => true
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		$inputValidator = $app->inputValidator;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'password' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				// TODO: implement
				return true;
			}),
			
			'emailAddress' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				// TODO: implement
				return true;
			}),
			
			'role' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				// TODO: implement
				return true;
			})
		]);
		
		// Validates the request and returns the result
		return $inputValidator->validateJsonRequest($app->request, $jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}
	
	/*
	 * Builds and returns the message of the user creation email.
	 * 
	 * It receives the template's file path and the request's password.
	 */
	private function buildEmailMessage($templateFilePath, $password) {
		// Gets the template
		$template = file_get_contents($templateFilePath);
		
		// Replaces the :password placeholder with the hexadecimal
		// representation of the password and returns the result
		return str_replace(':password', bin2hex($password), $template);
	}
	
	/*
	 * Rejects the user creation request.
	 */
	private function rejectRequest() {
		$app = $this->app;
		
		// Sets the output
		$app->response->setBody([
			'requestAccepted' => false
		]);
		
		// Stops the execution
		$app->stop();
	}

}
