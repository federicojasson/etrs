<?php

// TODO: remove class
class TestGetAuthenticationStateController extends Controller {
	
	protected function executeLogic() {
		sleep(0);
		
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
