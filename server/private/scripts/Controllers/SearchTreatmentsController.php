<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/search-treatments
 *	Method:	POST
 */
class SearchTreatmentsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		$businessLogicDatabase = $app->businessLogicDatabase;
		
		// Gets the input
		$input = $app->request->getBody();
		$query = $input['query'];
		$page = $input['page'];
		
		if ($query === '*') {
			// Selects the treatments
			$treatments = $businessLogicDatabase->selectNonErasedTreatments();
		} else {
			// Gets the search expression from the query
			$searchExpression = getSearchExpressionFromQuery($query);

			// Gets the limit and the offset, in function of the requested page
			$limit = SEARCH_RESULTS_PER_PAGE;
			$offset = $limit * ($page - 1);

			// Selects the treatments
			$treatments = $businessLogicDatabase->selectNonErasedTreatmentsByFullTextSearch($searchExpression, $limit, $offset); // TODO: implement
		}
		
		// Filters the treatments and gets their IDs
		$filteredTreatmentIds = [];
		$count = count($treatments);
		for ($i = 0; $i < $count; $i++) {
			$filteredTreatmentIds[$i] = $app->dataFilter->filterTreatment($treatments[$i])['id'];
		}
		
		// Selects the found rows
		$foundRows = $businessLogicDatabase->selectFoundRows();
		
		// Sets the output
		$app->response->setBody([
			'totalResults' => $foundRows,
			'results' => $filteredTreatmentIds
		]);
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
			}),
			
			'page' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				return $inputValidator->isPositiveInteger($jsonValue);
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
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
