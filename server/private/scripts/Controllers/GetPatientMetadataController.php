<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-patient-metadata
 *	Method:	POST
 */
class GetPatientMetadataController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the patient ID
		$patientId = $input['id'];
		
		// Gets the patient
		$patient = $app->data->getPatient($patientId, ['metadata']);
		
		if (is_null($patient)) {
			// The patient doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_PATIENT
			]);
		}
		
		// Sets the output
		$app->response->setBody($patient['metadata']);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// TODO: implement
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		// TODO: implement
	}

}
