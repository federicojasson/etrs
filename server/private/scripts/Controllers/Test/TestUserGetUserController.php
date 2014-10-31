<?php

// TODO: remove class
class TestUserGetUserController extends Controller {
	
	protected function executeLogic() {
		sleep(1);
		
		$users = [
			'federicojasson' => [
				'firstNames' => 'Federico',
				'gender' => 'M',
				'id' => 'federicojasson',
				'lastNames' => 'Jasson',
				'role' => 'DR'
			]
		];
		
		$app = $this->app;
		
		$input = $app->request->getBody();
		$userId = $input['userId'];
		
		if (! isset($users[$userId])) {
			$app->halt(HTTP_STATUS_NOT_FOUND);
		}
		
		$app->response->setBody([
			'user' => $users[$userId]
		]);
	}
	
	protected function isInputValid() {
		return true;
	}
	
	protected function isUserAuthorized() {
		return true;
	}
	
}
