<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-consultation-patient-medications
 *	Method:	POST
 */
class GetConsultationPatientMedicationsController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the consultation ID
		$consultationId = $input['id'];
		
		// Gets the consultation
		$consultation = $app->data->getConsultation($consultationId, ['patientMedications']);
		
		if (is_null($consultation)) {
			// The consultation doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_CONSULTATION
			]);
		}
		
		// Sets the output
		$app->response->setBody($consultation['patientMedications']);
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
