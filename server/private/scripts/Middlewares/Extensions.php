<?php

namespace App\Middlewares;

/*
 * This middleware defines extensions for vendors' components.
 */
class Extensions extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// TODO: Middlewares/Extensions.php
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
