<?php

// TODO: remove class
class TestUserGetUserController extends Controller {
	
	protected function executeLogic() {
		$this->app->response->setBody([
			'user' => [
				'firstNames' => 'Federico',
				'gender' => 'M',
				'id' => 1251,
				'lastNames' => 'Jasson',
				'role' => 'DR'
			]
		]);
	}
	
	protected function isInputValid() {
		return true;
	}
	
	protected function isUserAuthorized() {
		return true;
	}
	
}
