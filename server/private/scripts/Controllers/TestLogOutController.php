<?php

// TODO: remove class
class TestLogOutController extends Controller {
	
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
