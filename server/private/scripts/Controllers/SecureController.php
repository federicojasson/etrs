<?php

/*
 * This class encapsulates the logic of a service that performs security checks.
 * 
 * Subclasses must implement the execution function. For security reasons, every
 * controller has to implement, also, a method to validate the input and another
 * one to check if the user is authorized to use the service. This is a measure
 * to help the developer not to forget to do this tasks.
 */
abstract class SecureController extends Controller {
	
	/*
	 * Serves the request.
	 * 
	 * Before executing the controller, it validates the input and checks if the
	 * user is authorized to use this service.
	 */
	public function serve() {
		$app = $this->app;
		
		if (! $this->isInputValid()) {
			// The input is invalid
			$app->halt(HTTP_STATUS_BAD_REQUEST, [
				'id' => ERROR_ID_INVALID_INPUT
			]);
		}
		
		if (! $this->isUserAuthorized()) {
			// The user is not authorized to use this service
			$app->halt(HTTP_STATUS_FORBIDDEN, [
				'id' => ERROR_ID_UNAUTHORIZED_USER
			]);
		}
		
		// Executes the controller
		$this->execute();
	}
	
	/*
	 * Executes the controller.
	 */
	protected abstract function execute();
	
	/*
	 * Determines whether the input is valid.
	 */
	protected abstract function isInputValid();
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected abstract function isUserAuthorized();
	
}
