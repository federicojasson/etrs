<?php

namespace App\Controller\ImageTest;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/image-test/search
 * Method:	POST
 */
class Search extends \App\Controller\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$expression = (is_null($input['expression']))? null : $input['expression'];
		$page = $input['page'];
		$sorting = $input['sorting'];
		
		// Searches the image tests
		list($total, $results) = $app->data->searchImageTests($expression, $page, $sorting);
		
		// Sets the output
		$app->response->setBody([
			'total' => $total,
			'results' => $results
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'expression' => new JsonValueDescriptor(function($input) use ($app) {
				if (is_null($input)) {
					return true;
				}
				
				return $app->inputValidator->isValidText($input, 1, 128);
			}),
			
			'page' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isBoundedInteger($input, 1);
			}),
			
			'sorting' => new JsonObjectDescriptor([
				'field' => new JsonValueDescriptor(function($input) {
					return isElementInArray($input, [
						'creationDatetime',
						'lastEditionDatetime',
						'name'
					]);
				}),
				
				'order' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isSortingOrder($input);
				})
			])
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
