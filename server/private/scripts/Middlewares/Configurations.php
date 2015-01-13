<?php

namespace App\Middlewares;

/*
 * This middleware applies general configurations.
 */
class Configurations extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// TODO: Middlewares/Configurations.php
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
