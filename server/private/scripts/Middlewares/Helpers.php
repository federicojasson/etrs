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
	 * Initializes the Authentication helper.
	 */
	public function initializeAuthenticationHelper() {
		return new \App\Helpers\Authentication();
	}
	
	/*
	 * Initializes the Cryptography helper.
	 */
	public function initializeCryptographyHelper() {
		return new \App\Helpers\Cryptography();
	}
	
	/*
	 * Initializes the EmailBuilder helper.
	 */
	public function initializeEmailBuilderHelper() {
		return new \App\Helpers\EmailBuilder();
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
		
		$container->singleton('authentication', [ $this, 'initializeAuthenticationHelper' ]);
		$container->singleton('cryptography', [ $this, 'initializeCryptographyHelper' ]);
		$container->singleton('emailBuilder', [ $this, 'initializeEmailBuilderHelper' ]);
		$container->singleton('services', [ $this, 'initializeServicesHelper' ]);
	}
	
}
