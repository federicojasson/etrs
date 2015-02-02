<?php

namespace App\Middleware;

/*
 * This middleware defines extensions for vendors' components.
 */
class Extensions extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Defines the extensions
		$this->defineExtensions();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Initializes the Request extension.
	 * 
	 * It receives the configurations.
	 */
	public function initializeRequestExtension($configurations) {
		return new \App\Extension\Request($configurations['environment']);
	}
	
	/*
	 * Initializes the Response extension.
	 */
	public function initializeResponseExtension() {
		return new \App\Extension\Response();
	}
	
	/*
	 * Defines the extensions.
	 */
	private function defineExtensions() {
		$app = $this->app;
		
		// Defines the extensions
		$app->container->singleton('request', [ $this, 'initializeRequestExtension' ]);
		$app->container->singleton('response', [ $this, 'initializeResponseExtension' ]);
	}
	
}
