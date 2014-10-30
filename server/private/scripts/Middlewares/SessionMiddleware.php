<?php

/*
 * This middleware takes care of the initialization and configuration of the
 * session.
 */
class SessionMiddleware extends \Slim\Middleware {
	
	/*
	 * The session storage handler.
	 */
	private $storageHandler;
	
	/*
	 * Creates an instance of this class.
	 * It receives the session storage handler to use.
	 */
	public function __construct($storageHandler) {
		$this->storageHandler = $storageHandler;
	}
	
	/*
	 * Executes the middleware's logic.
	 */
	public function call() {
		$session = $this->app->session;
		
		// Sets the session storage handler
		$session->setStorageHandler($this->storageHandler);
		
		// Starts the session
		$session->start();
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
