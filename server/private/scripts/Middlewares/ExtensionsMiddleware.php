<?php

/*
 * This middleware registers the extensions of the application.
 */
class ExtensionsMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		// Registers the extensions
		$this->registerExtensions();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Registers the extensions.
	 */
	private function registerExtensions() {
		$container = $this->app->container;
		
		// Request extension
		$container->singleton('request', function($configurations) {
			return new Request($configurations['environment']);
		});
		
		// Response extension
		$container->singleton('response', function() {
			return new Response();
		});
	}
	
}
