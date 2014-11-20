<?php

/*
 * This controller implements the following service:
 * 
 *	URL:	/server/log-in
 *	Method:	POST
 */
class LogInController extends SecureController {
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		parent::__construct([
			USER_ROLE_ANONYMOUS
		]);
	}
	
	/*
	 * Executes the controller's logic.
	 */
	protected function executeLogic() {
		// TODO
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		$request = $app->request;
		$validator = $app->validator;
		
		// Gets the input
		$input = $request->getBody();
		
		// Defines the JSON structure
		$jsonStructure = [
			JSON_STRUCTURE_KEY_TYPE => JSON_STRUCTURE_TYPE_OBJECT,
			JSON_STRUCTURE_KEY_DEFINITION => [
				'userId' => [ JSON_STRUCTURE_KEY_TYPE => JSON_STRUCTURE_TYPE_VALUE ],
				'userPassword' => [ JSON_STRUCTURE_KEY_TYPE => JSON_STRUCTURE_TYPE_VALUE ]
			]
		];
		
		if (! $validator->hasValidJsonStructure($input, $jsonStructure)) {
			// The input doesn't have the expected JSON structure
			return false;
		}
		
		$userId = $input['userId'];
		if (! $validator->hasMinimumLength($userId, 1)) {
			return false;
		}
		
		$userPassword = $input['userPassword'];
		if (! $validator->hasMinimumLength($userPassword, 1)) {
			return false;
		}
		
		return true;
	}
	
}
