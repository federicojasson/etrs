<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/change-password
 *	Method:	POST
 */
class ChangePasswordController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		// TODO: clean code
		
		$app = $this->app;
		$cryptography = $app->cryptography;
		$response = $app->response;
		
		// Gets the input
		$input = $app->request->getBody();
		$currentPassword = $input['currentPassword'];
		$newPassword = $input['newPassword'];
		
		// Gets the logged in user
		$loggedInUser = $app->authentication->getLoggedInUser();
		
		$authenticated = false;
		if ($app->authenticator->authenticateUser($loggedInUser['id'], $currentPassword)) {
			// The user was authenticated
			$authenticated = true;
			
			// Computes the new password hash
			$passwordSalt = $cryptography->generatePasswordSalt();
			$passwordHash = $cryptography->hashPasswordSha512($newPassword, $passwordSalt);

			// Changes the password
			$app->businessLogicDatabase->updateUserAuthenticationData($loggedInUser['id'], $passwordHash, $passwordSalt);
		}
		
		// Sets the response body
		$response->setBody([
			authenticated => $authenticated
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'currentPassword' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function() {
				// TODO: validation
				return true;
			}),
			
			'newPassword' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function() {
				// TODO: validation
				return true;
			})
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($app->request, $jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
