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
		// Defines the extensions
		$this->defineExtensions();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Initializes the Request extension.
	 */
	public function initializeRequestExtension($configurations) {
		return new \App\Extensions\Request($configurations['environment']);
	}
	
	/*
	 * Initializes the Response extension.
	 */
	public function initializeResponseExtension() {
		return new \App\Extensions\Response();
	}
	
	/*
	 * Defines the extensions.
	 */
	private function defineExtensions() {
		$app = $this->app;
		
		$app->container->singleton('request', [ $this, 'initializeRequestExtension' ]);
		$app->container->singleton('response', [ $this, 'initializeResponseExtension' ]);
	}
	
}
