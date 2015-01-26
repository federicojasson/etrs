<?php

// TODO: test upload file

namespace App\Controllers\Test;

class Upload extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		$uploaddir = 'private/files/test/';
		$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
		move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		return true;
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		return true;
	}
	
}

