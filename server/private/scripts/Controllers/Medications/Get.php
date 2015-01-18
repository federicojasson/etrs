<?php

namespace App\Controllers\Medications;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/medications/get
 *	Method:	POST
 */
class Get extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$id = $input['id'];
		
		// Starts a read-only transaction
		$app->businessLogicDatabase->startReadOnlyTransaction();
		
		// Gets the medication
		$medication = $app->businessLogicDatabase->getNonErasedMedication($id);
		
		if (is_null($medication)) {
			// The medication doesn't exist
			
			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_MEDICATION
			]);
		}
		
		// Filters the medication
		$filteredMedication = $app->dataFilter->filterMedication($medication);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
		
		// Sets the output
		$app->response->setBody($filteredMedication);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement validation
				return true;
			})
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		// TODO: Controllers/Medications/Get.php
	}
	
}
