<?php

/*
 * This middleware defines the extensions of the application.
 */
class ExtensionsMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		$container = $this->app->container;
		
		// Defines the extensions
		$container->singleton('request', [ $this, 'initializeRequestExtension' ]);
		$container->singleton('response', [ $this, 'initializeResponseExtension' ]);
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Initializes the request extension.
	 */
	public function initializeRequestExtension($configurations) {
		return new Request($configurations['environment']);
	}
	
	/*
	 * Initializes the response extension.
	 */
	public function initializeResponseExtension() {
		return new Response();
	}
	
}
