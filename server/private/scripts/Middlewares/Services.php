<?php

namespace App\Middlewares;

/*
 * This middleware defines the services.
 */
class Services extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// TODO: Middlewares/Services.php
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
