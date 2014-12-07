<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/log-in
 *	Method:	POST
 */
class LogInController extends SecureController {
	
	/*
	 * TODO: comments
	 */
	private $input;
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		// TODO: implement
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescription = new JsonStructureDescription(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new JsonStructureDescription(JSON_STRUCTURE_TYPE_VALUE, function() {
				// TODO: validation
				return true;
			}),
			
			'password' => new JsonStructureDescription(JSON_STRUCTURE_TYPE_VALUE, function() {
				// TODO: validation
				return true;
			})
		]);
		
		// Validates the JSON request and returns the result
		return $app->inputValidator->validateJsonRequest($app->request, $jsonStructureDescription, $this->input);
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		// TODO: implement
	}

}
