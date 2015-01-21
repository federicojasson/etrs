<?php

namespace App\Controllers\Medications;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/medications/search
 *	Method:	POST
 */
class Search extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$expression = $input['expression'];
		$sortCriterion = $input['sortCriterion'];
		$page = $input['page'];
		
		// TODO: process expression
		$TODOexpression = $expression;
		
		// Calculates the limit and the offset, in function of the page
		$limit = SEARCH_RESULTS_PER_PAGE;
		$offset = $limit * ($page - 1);
		
		// Searches the medications
		$medications = $app->businessLogicDatabase->searchNonErasedMedications($TODOexpression, $sortCriterion, $limit, $offset); // TODO: implement
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Gets the results
		$results = [];
		$count = count($medications);
		for ($i = 0; $i < $count; $i++) {
			$results[$i] = bin2hex($medications[$i]['id']);
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
				// TODO: implement validation
				return true;
			}),
			
			'sortCriterion' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
				'field' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isCertainString($input, [
						// TODO: define sort fields
					]);
				}),
				
				'order' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isCertainString($input, [
						'ascending',
						'descending'
					]);
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
			// TODO: define authorized user roles
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
