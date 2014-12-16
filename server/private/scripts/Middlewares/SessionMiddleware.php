<?php

/*
 * This middleware initializes the session.
 */
class SessionMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		// Initializes the session
		$this->initializeSession();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Initializes the session.
	 */
	private function initializeSession() {
		$app = $this->app;
		$session = $app->session;
		
		// Initializas the session storage handler
		$sessionStorageHandler = new DatabaseSessionStorageHandler($app->webServerDatabase);
		
		// Sets the session storage handler
		$session->setStorageHandler($sessionStorageHandler);
		
		// Starts the session
		$session->start();
	}
	
}
