<?php

namespace App\Middleware;

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
		return new \App\Helper\Authentication();
	}
	
	/*
	 * Initializes the Cryptography helper.
	 */
	public function initializeCryptographyHelper() {
		return new \App\Helper\Cryptography();
	}
	
	/*
	 * Initializes the Data helper.
	 */
	public function initializeDataHelper() {
		return new \App\Helper\Data();
	}
	
	/*
	 * Initializes the InputValidator helper.
	 */
	public function initializeInputValidatorHelper() {
		return new \App\Helper\InputValidator();
	}
	
	/*
	 * Initializes the Parameters helper.
	 */
	public function initializeParametersHelper() {
		return new \App\Helper\Parameters();
	}
	
	/*
	 * Initializes the Services helper.
	 */
	public function initializeServicesHelper() {
		return new \App\Helper\Services();
	}
	
	/*
	 * Initializes the Session helper.
	 */
	public function initializeSessionHelper() {
		return new \App\Helper\Session();
	}
	
	/*
	 * Initializes the WebServerDatabase helper.
	 */
	public function initializeWebServerDatabaseHelper() {
		return new \App\Helper\Database\WebServerDatabase();
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
		$app->container->singleton('inputValidator', [ $this, 'initializeInputValidatorHelper' ]);
		$app->container->singleton('parameters', [ $this, 'initializeParametersHelper' ]);
		$app->container->singleton('services', [ $this, 'initializeServicesHelper' ]);
		$app->container->singleton('session', [ $this, 'initializeSessionHelper' ]);
		$app->container->singleton('webServerDatabase', [ $this, 'initializeWebServerDatabaseHelper' ]);
	}
	
}
