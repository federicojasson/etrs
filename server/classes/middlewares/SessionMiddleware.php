<?php

/*
 * TODO
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
	 * Starts the session and sets its storage handler.
	 */
	public function call() {
		// Gets the session
		$session = $this->app->session;
		
		// Sets the storage handler
		$session->setStorageHandler($this->storageHandler);
		
		// Starts the session
		$session->start();
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
