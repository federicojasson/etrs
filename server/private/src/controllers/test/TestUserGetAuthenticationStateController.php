<?php

// TODO: remove class
class TestUserGetAuthenticationStateController extends Controller {
	
	protected function executeLogic() {
		$this->app->response->setBody([
			'loggedIn' => true,
			'userId' => 1251
		]);
	}
	
	protected function isInputValid() {
		return true;
	}
	
	protected function isUserAuthorized() {
		return true;
	}
	
}
