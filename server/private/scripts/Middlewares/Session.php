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
		// TODO: Middlewares/Session.php
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
