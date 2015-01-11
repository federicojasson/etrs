<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-image-tests
 *	Method:	POST
 */
class GetImageTestsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Selects the image tests
		$imageTests = $app->businessLogicDatabase->selectNonErasedImageTests();
		
		// Filters the image tests
		$filteredImageTests = [];
		$count = count($imageTests);
		for ($i = 0; $i < $count; $i++) {
			$filteredImageTests[$i] = $app->dataFilter->filterImageTest($imageTests[$i]);
		}
		
		// Sets the output
		$app->response->setBody($filteredImageTests);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			// TODO: add authorized user roles?
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
