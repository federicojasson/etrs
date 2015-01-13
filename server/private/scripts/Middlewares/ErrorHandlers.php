<?php

namespace App\Middlewares;

/*
 * This middleware defines the error handlers.
 */
class ErrorHandlers extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// TODO: Middlewares/ErrorHandlers.php
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
