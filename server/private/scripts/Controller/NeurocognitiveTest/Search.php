<?php

namespace App\Controller\NeurocognitiveTest;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/neurocognitive-test/search
 * Method:	POST
 */
class Search extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$expression = $this->getInput('expression');
		$page = $this->getInput('page');
		$sorting = $this->getInput('sorting');
		
		// Searches the neurocognitive tests
		list($total, $results) = $app->data->neurocognitiveTest->search($expression, $page, $sorting);
		
		// Sets the output
		$this->replaceOutput([
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
			'lastEditionDatetime',
			'name'
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
			USER_ROLE_DOCTOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
