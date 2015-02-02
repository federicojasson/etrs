<?php

namespace App\Middleware;

use \App\Helper as Helper;

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
		return new Helper\Authentication();
	}
	
	/*
	 * Initializes the Cryptography helper.
	 */
	public function initializeCryptographyHelper() {
		return new Helper\Cryptography();
	}
	
	/*
	 * Initializes the Data helper.
	 */
	public function initializeDataHelper() {
		return new Helper\Data();
	}
	
	/*
	 * Initializes the Services helper.
	 */
	public function initializeServicesHelper() {
		return new Helper\Services();
	}
	
	/*
	 * Initializes the Session helper.
	 */
	public function initializeSessionHelper() {
		return new Helper\Session();
	}
	
	/*
	 * Initializes the WebServerDatabase helper.
	 */
	public function initializeWebServerDatabaseHelper() {
		return new Helper\Database\WebServerDatabase();
	}
	
	/*
	 * Defines the helpers.
	 */
	private function defineHelpers() {
		$app = $this->app;
		
		// Defines the helpers
		$app->container->singleton('authentication', [ $this, 'initializeAuthenticationHelper' ]);
		$app->container->singleton('cryptography', [ $this, 'initializeCryptographyHelper' ]);
		$app->container->singleton('data', [ $this, 'initializeDataHelper' ]);
		$app->container->singleton('services', [ $this, 'initializeServicesHelper' ]);
		$app->container->singleton('session', [ $this, 'initializeSessionHelper' ]);
		$app->container->singleton('webServerDatabase', [ $this, 'initializeWebServerDatabaseHelper' ]);
	}
	
}
