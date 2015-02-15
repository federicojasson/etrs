<?php

namespace App\Controller\Log;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/log/search
 * Method:	POST
 */
class Search extends \App\Controller\SpecializedExternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$expression = $this->getInput('expression');
		$page = $this->getInput('page');
		$sorting = $this->getInput('sorting');
		
		// Searches the logs
		list($total, $results) = $app->data->log->search($expression, $page, $sorting);
		
		// Sets the output
		$this->setEntireOutput([
			'total' => $total,
			'results' => $results
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// Gets the JSON structure descriptor
		$jsonStructureDescriptor = $this->getSearchJsonStructureDescriptor([
			'creationDatetime',
			'level',
			'message'
		]);
		
		// Validates the JSON input and returns the result
		return $this->validateJsonInput($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
