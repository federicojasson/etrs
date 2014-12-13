<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-study-files
 *	Method:	POST
 */
class GetStudyFilesController extends SecureController {
	
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
		$study = $app->data->getStudy($studyId, ['files']);
		
		if (is_null($study)) {
			// The study doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_STUDY
			]);
		}
		
		// Sets the output
		$app->response->setBody($study['files']);
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
