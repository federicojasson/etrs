<?php

/*
 * This class encapsulates the logic of a server service.
 * 
 * Subclasses must implement the service's logic. For security reasons, every
 * controller has to implement, also, a method to validate the input and another
 * one to check if the user is authorized to access to the service, even though
 * this might be unnecessary in some cases (for example, if the service receives
 * no input). This is just a measure to help the developer not to forget to
 * check the input and verify the user's permissions.
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
	 * Executes the controller's logic, but, before, it checks if the input is
	 * valid and whether the user is authorized to execute this service.
	 */
	public function call() {
		$app = $this->app;
		
		if (! $this->isInputValid()) {
			// The input is invalid
			$app->halt(HTTP_STATUS_BAD_REQUEST);
		}
		
		if (! $this->isUserAuthorized()) {
			// The user is not authorized to execute this service
			$app->halt(HTTP_STATUS_FORBIDDEN);
		}
		
		// Executes the logic
		$this->executeLogic();
	}
	
	/*
	 * Executes the controller's logic.
	 */
	protected abstract function executeLogic();
	
	/*
	 * Determines whether the input is syntactically valid.
	 */
	protected abstract function isInputValid();
	
	/*
	 * Determines whether the user is authorized to execute this service.
	 */
	protected abstract function isUserAuthorized();
	
}
