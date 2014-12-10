<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-consultation-image-analysis
 *	Method:	POST
 */
class GetConsultationImageAnalysisController extends SecureController {
	
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
		$consultation = $app->data->getConsultation($consultationId, ['imageAnalysis']);
		
		// Sets the output
		$app->response->setBody($consultation['imageAnalysis']);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function() {
				// TODO: validation
				return true;
			})
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($app->request, $jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		// TODO: implement
		return true;
	}

}
