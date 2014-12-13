<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-file-metadata
 *	Method:	POST
 */
class GetFileMetadataController extends SecureController {
	
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
		$file = $app->data->getFile($fileId, ['metadata']);
		
		if (is_null($file)) {
			// The file doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_FILE
			]);
		}
		
		// Sets the output
		$app->response->setBody($file['metadata']);
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
