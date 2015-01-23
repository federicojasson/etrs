<?php

namespace App\Controllers\Experiments;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/experiments/search
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
		$expression = trimString($input['expression']);
		$sortingCriterion = $input['sortingCriterion'];
		$page = $input['page'];
		
		// Gets a boolean expression
		$booleanExpression = getBooleanExpression($expression);
		
		// Gets the ORDER BY clause
		$orderByClause = getOrderByClause($sortingCriterion);
		
		// Calculates the limit and the offset, in function of the page
		$limit = RESULTS_PER_PAGE;
		$offset = $limit * ($page - 1);
		
		// Searches the experiments
		$experiments = $app->businessLogicDatabase->searchNonErasedExperiments($booleanExpression, $orderByClause, $limit, $offset);
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Gets the results
		$results = [];
		$count = count($experiments);
		for ($i = 0; $i < $count; $i++) {
			$results[$i] = bin2hex($experiments[$i]['id']);
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
				$input = trimString($input);
				
				return	$app->inputValidator->isNonEmptyString($input) &&
						$app->inputValidator->isBoundedString($input, 128) &&
						$app->inputValidator->isPrintableString($input);
			}),
			
			'sortingCriterion' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
				'field' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isPredefinedString($input, [
						'creation_datetime',
						'last_edition_datetime',
						'name'
					]);
				}),
				
				'order' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isPredefinedString($input, [
						SORTING_ORDER_ASCENDING,
						SORTING_ORDER_DESCENDING
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
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
			// TODO: USER_ROLE_OPERATOR?
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
