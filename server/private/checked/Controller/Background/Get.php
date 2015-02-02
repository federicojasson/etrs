<?php

namespace App\Controller\TODO;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/TODO/TODO
 * Method:	POST
 */
class TODO extends \App\Controller\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		// TODO: implement
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor([
			'id' => new \App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			})
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		// TODO: implement
	}
	
}
