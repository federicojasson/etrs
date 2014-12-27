<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/request-password-recovery
 *	Method:	POST
 */
class RequestPasswordRecoveryController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		$cryptography = $app->cryptography;
		$webServerDatabase = $app->webServerDatabase;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the user's ID and her alleged email address
		$userId = $input['id'];
		$userAllegedEmailAddress = $input['emailAddress'];
		
		// Gets the user
		$user = $app->data->getUser($userId);
		
		if (is_null($user)) {
			// The user doesn't exist
			$this->rejectRequest();
		}
		
		if ($userAllegedEmailAddress !== $user['emailAddress']) {
			// The email addresses don't match
			$this->rejectRequest();
		}
		
		// Starts a transaction
		$webServerDatabase->startTransaction();
		
		// Deletes any previous password recovery request of the user
		$webServerDatabase->deleteUserPasswordRecoveryRequests($userId);
		
		// Generate a random ID
		do {
			$id = $cryptography->generateRandomId();
		} while ($webServerDatabase->passwordRecoveryRequestExists($id));
		
		// Generates a random password
		$password = $cryptography->generateRandomPassword();
		
		// Computes the hash of the password
		$passwordSalt = $cryptography->generatePasswordSalt();
		$passwordIterations = PASSWORD_ITERATIONS;
		$passwordHash = $cryptography->hashPassword($password, $passwordSalt, $passwordIterations);
		
		// Inserts a password recovery request
		$webServerDatabase->insertPasswordRecoveryRequest($id, $userId, $passwordHash, $passwordSalt, $passwordIterations);
		
		// Commits the transaction
		$webServerDatabase->commitTransaction();
		
		// Gets the email configuration
		$configuration = $app->configurations->get('email');
		
		$webServerEmailAddress = $configuration['webServerEmailAddress'];
		$templateFilePath = $configuration['passwordRecoveryEmail']['templateFilePath'];
		
		// Builds the email message
		$emailMessage = $this->buildEmailMessage($templateFilePath, $password);
		
		// Sends an email to the user with a link for password recovery
		$app->emailBuilder
		->newEmail()
		->from($webServerEmailAddress)
		->to($userAllegedEmailAddress)
		->subject('ETRS - Recuperación de contraseña')
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
			'id' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				return $inputValidator->isNonEmptyString($jsonValue);
			}),
			
			'emailAddress' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				return $inputValidator->isNonEmptyString($jsonValue);
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
			USER_ROLE_ANONYMOUS
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}
	
	/*
	 * Builds and returns the message of the password recovery email.
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
	 * Rejects the password recovery request. This implies setting the proper
	 * output and stopping the execution.
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
