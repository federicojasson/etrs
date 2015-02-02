<?php

namespace App\Middleware;

use App\Auxiliar\SessionStorageHandler\DatabaseSessionStorageHandler;

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
		
		// Configures the generation of session IDs
		// 4 bits per character are used so that the resulting IDs can be
		// written in hexadecimal format
		$app->session->configureIdsGeneration('sha256', 4);
		
		// Initializes a session storage handler
		$storageHandler = new DatabaseSessionStorageHandler();
		
		// Sets the session's storage handler
		$app->session->setStorageHandler($storageHandler);
		
		// Starts the session
		$app->session->start();
	}
	
}
