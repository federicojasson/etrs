<?php

/*
 * This class offers a middleware service to handle the session transparently.
 * It's responsible for starting the session and for registering a session
 * storage handler to manage the data persistence process.
 */
class SessionMiddleware extends \Slim\Middleware {
	
	/*
	 * The session.
	 */
	private $session;
	
	/*
	 * The session storage handler.
	 */
	private $sessionStorageHandler;
	
	/*
	 * Creates an instance of this class.
	 * It receives the session and the session storage handler to use.
	 */
	public function __construct($session, $sessionStorageHandler) {
		$this->session = $session;
		$this->sessionStorageHandler = $sessionStorageHandler;
	}
	
	/*
	 * Performs the middleware tasks.
	 */
	public function call() {
		// Registers the session storage handler
		$this->session->setStorageHandler($this->sessionStorageHandler);
		
		// Starts the session
		$this->session->start();
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
