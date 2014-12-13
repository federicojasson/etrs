<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-user-main-data
 *	Method:	POST
 */
class GetUserMainDataController extends SecureController {
	
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
		$user = $app->data->getUser($userId, ['mainData']);
		
		if (is_null($user)) {
			// The user doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_USER
			]);
		}
		
		// Sets the output
		$app->response->setBody($user['mainData']);
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
