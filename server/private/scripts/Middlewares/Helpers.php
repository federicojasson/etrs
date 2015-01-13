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
		// Defines the helpers
		$this->defineHelpers();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Initializes the Services helper.
	 */
	public function initializeServicesHelper() {
		return new \App\Helpers\Services();
	}
	
	/*
	 * Defines the helpers.
	 */
	private function defineHelpers() {
		$container = $this->app->container;
		
		$container->singleton('services', [ $this, 'initializeServicesHelper' ]);
	}
	
}
