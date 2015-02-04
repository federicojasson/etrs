<?php

namespace App\Controllers\Experiments;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/experiments/search
 * Method:	POST
 */
class Search extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$expression = (is_null($input['expression']))? null : $input['expression'];
		$sorting = $input['sorting'];
		$page = $input['page'];
		
		// Calculates the limit and the offset, in function of the page
		$limit = RESULTS_PER_PAGE;
		$offset = $limit * ($page - 1);
		
		if (is_null($expression)) {
			// All experiments should be included in the search
			$experiments = $app->businessLogicDatabase->searchAllNonDeletedExperiments($sorting, $limit, $offset);
		} else {
			// Only specific experiments should be included in the search
			$experiments = $app->businessLogicDatabase->searchSpecificNonDeletedExperiments($sorting, $expression, $limit, $offset);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Gets the results
		$results = [];
		foreach ($experiments as $experiment) {
			$results[] = bin2hex($experiment['id']);
		}
		
		// Sets the output
		$app->response->setBody([
			'totalResults' => $foundRows,
			'results' => $results
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'expression' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (is_null($input)) {
					return true;
				}
				
				if (! is_string($input)) {
					return false;
				}
				
				$input = trimString($input);
				
				return	$app->inputValidator->isNonEmptyString($input) &&
						$app->inputValidator->isValidString($input, 128) &&
						$app->inputValidator->isPrintableString($input);
			}),
			
			'sorting' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
				'field' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return isElementInArray($input, [
						'creationDatetime',
						'lastEditionDatetime',
						'name'
					]);
				}),
				
				'order' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isSortingOrder($input);
				})
			]),
			
			'page' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isPositiveInteger($input);
			})
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
			USER_ROLE_OPERATOR
		];
		
		// Validates the account and returns the result
		return $app->authorizationValidator->validateAccount($authorizedUserRoles);
	}
	
}
