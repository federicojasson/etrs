<?php

// TODO: remove class
class TestUserLogInController extends Controller {
	
	protected function executeLogic() {
		sleep(1);
		
		$this->app->response->setBody([
			'loggedIn' => true,
		]);
	}
	
	protected function isInputValid() {
		return true;
	}
	
	protected function isUserAuthorized() {
		return true;
	}
	
}
