<?php

// TODO: remove class
class TestUserLogInController extends Controller {
	
	protected function executeLogic() {
		sleep(1);
		
		// TODO: testing
		$this->app->halt(HTTP_STATUS_FORBIDDEN, [
			'errorCode' => 'ERROR_TESTING',
		]);
		
		$this->app->response->setBody([
			'loggedIn' => false,
		]);
	}
	
	protected function isInputValid() {
		return true;
	}
	
	protected function isUserAuthorized() {
		return true;
	}
	
}
