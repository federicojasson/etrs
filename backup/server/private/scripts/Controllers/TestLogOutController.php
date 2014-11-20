<?php

// TODO: remove class
class TestLogOutController extends SecureController {
	
	protected function executeLogic() {
		sleep(1);
	}
	
	protected function isInputValid() {
		return true;
	}
	
}
