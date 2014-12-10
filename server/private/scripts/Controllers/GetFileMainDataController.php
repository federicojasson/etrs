<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-file-main-data
 *	Method:	POST
 */
class GetFileMainDataController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the file ID
		$fileId = $input['id'];
		
		// Gets the file
		$file = $app->data->getFile($fileId, ['mainData']);
		
		// Sets the output
		$app->response->setBody($file['mainData']);
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
