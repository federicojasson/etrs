<?php

/*
 * This middleware performs tasks related to the PHP session.
 */
class SessionMiddleware extends \Slim\Middleware {
	
	/*
	 * The session storage handler.
	 */
	private $sessionStorageHandler;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the session storage handler to use.
	 */
	public function __construct($sessionStorageHandler) {
		$this->sessionStorageHandler = $sessionStorageHandler;
	}
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		$session = $this->app->session;
		
		// Sets the session storage handler
		$session->setStorageHandler($this->sessionStorageHandler);
		
		// Starts the session
		$session->start();
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
