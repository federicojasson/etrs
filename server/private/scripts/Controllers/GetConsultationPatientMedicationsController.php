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
		$app = $this->app;
		$inputValidator = $app->inputValidator;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				return $inputValidator->isValidConsultationId($jsonValue);
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
		
		// TODO: is $authorizedUserRoles ok?
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
