<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-clinical-impressions
 *	Method:	POST
 */
class GetClinicalImpressionsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Selects the clinical impressions
		$clinicalImpressions = $app->businessLogicDatabase->selectNonErasedClinicalImpressions();
		
		// Filters the clinical impressions
		$filteredClinicalImpressions = [];
		$count = count($clinicalImpressions);
		for ($i = 0; $i < $count; $i++) {
			$filteredClinicalImpressions[$i] = $app->dataFilter->filterClinicalImpression($clinicalImpressions[$i]);
		}
		
		// Sets the output
		$app->response->setBody($filteredClinicalImpressions);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			// TODO: add authorized user roles?
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
