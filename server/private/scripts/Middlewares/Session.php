<?php

namespace App\Middlewares;

/*
 * This middleware initializes the session.
 */
class Session extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
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
		
		// Initializas a session storage handler
		$storageHandler = new \App\Auxiliars\DatabaseSessionStorageHandler();
		
		// Sets the session's storage handler
		$app->session->setStorageHandler($storageHandler);
		
		// Starts the session
		$app->session->start();
	}
	
}
