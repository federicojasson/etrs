<?php

namespace App\Controller;

/*
 * This class encapsulates the logic of a service that performs security checks.
 * 
 * Subclasses must implement the call function. For security reasons, every
 * controller has to implement, also, the isInputValid method to validate the
 * input and the isUserAuthorized function to check if the user is authorized to
 * use the service. This is a measure to help the developer not to forget to do
 * these tasks.
 */
abstract class SecureController extends Controller {
	
	/*
	 * Serves the request.
	 */
	public function serveRequest() {
		$app = $this->app;
		
		// TODO: invert order if input is never used in isUserAuthorized
		
		if (! $this->isInputValid()) {
			// The input is invalid
			
			// Halts the execution
			$app->halt(HTTP_STATUS_BAD_REQUEST, [
				'error' => ERROR_INVALID_INPUT
			]);
		}
		
		if (! $this->isUserAuthorized()) {
			// The user is not authorized to use this service
			
			// Halts the execution
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
