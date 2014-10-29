<?php

// TODO: remove class
class TestUserLogOutController extends Controller {
	
	protected function executeLogic() {
		sleep(1);
	}
	
	protected function isInputValid() {
		return true;
	}
	
	protected function isUserAuthorized() {
		return true;
	}
	
}
