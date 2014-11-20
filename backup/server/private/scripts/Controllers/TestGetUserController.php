<?php

// TODO: remove class
class TestGetUserController extends SecureController {
	
	protected function executeLogic() {
		sleep(0);
		
		$users = [
			'federicojasson' => [
				'gender' => 'M',
				'id' => 'federicojasson',
				'name' => [
					'firstName' => 'Federico',
					'lastName' => 'Jasson'
				],
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
	
}
