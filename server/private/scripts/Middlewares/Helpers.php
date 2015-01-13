<?php

namespace App\Middlewares;

/*
 * This middleware defines the helpers.
 */
class Helpers extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// TODO: Middlewares/Helpers.php
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
