<?php

namespace App\Controllers\Patients;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/patients/get-all
 *	Method:	POST
 */
class GetAll extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$sorting = $input['sorting'];
		$page = $input['page'];
		
		// Gets the ORDER BY clause
		$orderByClause = getOrderByClause($sorting);
		
		// Calculates the limit and the offset, in function of the page
		$limit = RESULTS_PER_PAGE;
		$offset = $limit * ($page - 1);
		
		// Gets all the patients
		$patients = $app->businessLogicDatabase->getAllNonErasedPatients($orderByClause, $limit, $offset);
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Gets the results
		$results = [];
		$count = count($patients);
		for ($i = 0; $i < $count; $i++) {
			$results[$i] = bin2hex($patients[$i]['id']);
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
			'sorting' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
				'field' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isPredefinedString($input, [
						'creation_datetime',
						'last_edition_datetime',
						'first_name',
						'last_name',
						'gender',
						'birth_date',
						'education_years'
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
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
