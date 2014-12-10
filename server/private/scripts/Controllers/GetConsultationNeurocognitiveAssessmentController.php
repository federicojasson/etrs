<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-consultation-neurocognitive-assessment
 *	Method:	POST
 */
class GetConsultationNeurocognitiveAssessmentController extends SecureController {
	
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
		$consultation = $app->data->getConsultation($consultationId, ['neurocognitiveAssessment']);
		
		// Sets the output
		$app->response->setBody($consultation['neurocognitiveAssessment']);
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
