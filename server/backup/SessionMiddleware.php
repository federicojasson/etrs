<?php

/*
 * This class offers a middleware service to handle the session transparently.
 * It's responsible for starting the session and for registering a session
 * storage handler to manage the data persistence process.
 */
class SessionMiddleware extends \Slim\Middleware {
	
	/*
	 * The session storage handler.
	 */
	private $sessionStorageHandler;
	
	/*
	 * Creates an instance of this class.
	 * It receives the session storage handler to use.
	 */
	public function __construct($sessionStorageHandler) {
		$this->sessionStorageHandler = $sessionStorageHandler;
	}
	
	/*
	 * Starts the session and sets its storage handler.
	 * Then, it calls the next middleware.
	 */
	public function call() {
		// Gets the session
		$session = $this->app->session;
		
		// Registers the session storage handler
		$session->setStorageHandler($this->sessionStorageHandler);
		
		// Starts the session
		$session->start();
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
