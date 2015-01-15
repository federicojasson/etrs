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
		
		// Initializas the session storage handler
		$sessionStorageHandler = new DatabaseSessionStorageHandler($app->webServerDatabase);
		
		// Sets the session storage handler
		$app->session->setStorageHandler($sessionStorageHandler);
		
		// Starts the session
		$app->session->start();
	}
	
}
