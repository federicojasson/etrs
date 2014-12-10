<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-user-metadata
 *	Method:	POST
 */
class GetUserMetadataController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the user ID
		$userId = $input['id'];
		
		// Gets the user
		$user = $app->data->getUser($userId, ['metadata']);
		
		// Sets the output
		$app->response->setBody($user['metadata']);
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
