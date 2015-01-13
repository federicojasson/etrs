<?php

namespace App\Controllers;

/*
 * This class encapsulates the logic of a service that performs security checks.
 * 
 * Subclasses must implement the execution function. For security reasons, every
 * controller has to implement, also, a method to validate the input and another
 * one to check if the user is authorized to use the service. This is a measure
 * to help the developer not to forget to do these tasks.
 */
abstract class SecureController extends \App\Controllers\Controller {
	
	/*
	 * Serves the request.
	 * 
	 * Before executing the controller, it validates the input and checks if the
	 * user is authorized to use the service.
	 */
	public function serveRequest() {
		$app = $this->app;
		
		if (! $this->isInputValid()) {
			// The input is invalid
			$app->halt(HTTP_STATUS_BAD_REQUEST, [
				'error' => ERROR_INVALID_INPUT
			]);
		}
		
		if (! $this->isUserAuthorized()) {
			// The user is not authorized to use this service
			$app->halt(HTTP_STATUS_FORBIDDEN, [
				'error' => ERROR_UNAUTHORIZED_USER
			]);
		}
		
		// Calls the controller
		$this->call();
	}
	
	/*
	 * Calls the controller.
	 */
	protected abstract function call();
	
	/*
	 * Determines whether the input is valid.
	 */
	protected abstract function isInputValid();
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected abstract function isUserAuthorized();
	
}
