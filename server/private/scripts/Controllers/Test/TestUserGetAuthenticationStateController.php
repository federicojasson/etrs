<?php

// TODO: remove class
class TestUserGetAuthenticationStateController extends Controller {
	
	protected function executeLogic() {
		sleep(0);
		
		$this->app->response->setBody([
			'loggedIn' => true,
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
