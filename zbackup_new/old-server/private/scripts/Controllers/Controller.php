<?php

/*
 * This class encapsulates the logic of a server service.
 * 
 * Subclasses must implement the service's logic. For security reasons, every
 * controller has to implement, also, a method to check if the user is
 * authorized to access the service and another one to validate the input, even
 * though this might be unnecessary in some cases (e.g., if the service receives
 * no input). This is just a measure to help the developer not to forget to
 * verify the user's permissions and check the input.
 */
abstract class Controller {
	
	/*
	 * The app.
	 */
	protected $app;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}
	
	/*
	 * Calls the controller.
	 * 
	 * Executes the controller's logic, but, before, it checks if the user is
	 * authorized to execute this service and whether the input is valid.
	 */
	public function call() {
		$app = $this->app;
		
		if (! $this->isUserAuthorized()) {
			// The user is not authorized to execute this service
			$app->halt(HTTP_STATUS_FORBIDDEN, [
				'errorId' => 'UNAUTHORIZED_USER'
			]);
		}
		
		if (! $this->isInputValid()) {
			// The input is invalid
			$app->halt(HTTP_STATUS_BAD_REQUEST, [
				'errorId' => 'INVALID_INPUT'
			]);
		}
		
		// Executes the logic
		$this->executeLogic();
	}
	
	/*
	 * Executes the controller's logic.
	 */
	protected abstract function executeLogic();
	
	/*
	 * Determines whether the input is valid.
	 */
	protected abstract function isInputValid();
	
	/*
	 * Determines whether the user is authorized to execute this service.
	 */
	protected abstract function isUserAuthorized();
	
}
