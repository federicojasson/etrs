<?php

// TODO: remove class
class TestGetAuthenticationStateController extends SecureController {
	
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
	
}
