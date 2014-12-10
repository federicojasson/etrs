<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-study-main-data
 *	Method:	POST
 */
class GetStudyMainDataController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the study ID
		$studyId = $input['id'];
		
		// Gets the study
		$study = $app->data->getStudy($studyId, ['mainData']);
		
		// Sets the output
		$app->response->setBody($study['mainData']);
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
