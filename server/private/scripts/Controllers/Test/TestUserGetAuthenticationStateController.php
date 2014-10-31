<?php

// TODO: remove class
class TestUserGetAuthenticationStateController extends Controller {
	
	protected function executeLogic() {
		sleep(1);
		
		$this->app->response->setBody([
			'loggedIn' => false,
			'userId' => 'federicojasson'
		]);
	}
	
	protected function isInputValid() {
		return true;
	}
	
	protected function isUserAuthorized() {
		return true;
	}
	
}
