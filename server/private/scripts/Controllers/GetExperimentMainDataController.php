<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-experiment-main-data
 *	Method:	POST
 */
class GetExperimentMainDataController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the experiment ID
		$experimentId = $input['id'];
		
		// Gets the experiment
		$experiment = $app->data->getExperiment($experimentId, ['mainData']);
		
		if (is_null($experiment)) {
			// The experiment doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_EXPERIMENT
			]);
		}
		
		// Sets the output
		$app->response->setBody($experiment['mainData']);
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
