<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/search-patients
 *	Method:	POST
 */
class SearchPatientsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the query
		$query = $input['query'];
		
		// Gets the search expression from the query
		$expression = $this->getExpressionFromQuery($query);
		
		// Selects the patients
		$patients = $app->businessLogicDatabase->selectNonErasedPatientsByFullTextSearch($expression);
		
		// Filters the patients and gets their IDs
		$filteredPatientIds = [];
		$count = count($patients);
		for ($i = 0; $i < $count; $i++) {
			$filteredPatientIds[$i] = $app->dataFilter->filterPatient($patients[$i])['id'];
		}
		
		// Sets the output
		$app->response->setBody($filteredPatientIds);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		$inputValidator = $app->inputValidator;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'query' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				return $inputValidator->isValidQuery($jsonValue);
			})
		]);
		
		// Validates the request and returns the result
		return $inputValidator->validateJsonRequest($app->request, $jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			// TODO: check authorized user roles
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}
	
	/*
	 * TODO: comments
	 */
	private function getExpressionFromQuery($query) {
		// Sanitizes the query
		$query = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $query);
		$query = preg_replace('/[^ 0-9A-Za-z]/', '', $query);
		$query = preg_replace('/[ ]+/', ' ', $query);
		$query = trim($query);
		
		if (getStringLength($query) === 0) {
			// The sanitized query is empty
			return '';
		}
		
		// Gets the words of the query
		$queryWords = explode(' ', $query);
		
		// Computes the words of the expression
		$expressionWords = [];
		$count = count($queryWords);
		for ($i = 0; $i < $count; $i++) {
			// Adds a wildcard to the end of the query's word
			$expressionWords[$i] = $queryWords[$i] . '*';
		}
		
		// Builds the expression concatenating its words
		$expression = implode(' ', $expressionWords);
		
		return $expression;
	}

}
