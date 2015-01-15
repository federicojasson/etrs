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
	 * Initializes the Authenticator helper.
	 */
	public function initializeAuthenticatorHelper() {
		return new \App\Helpers\Authenticator();
	}
	
	/*
	 * Initializes the AuthorizationValidator helper.
	 */
	public function initializeAuthorizationValidatorHelper() {
		return new \App\Helpers\AuthorizationValidator();
	}
	
	/*
	 * Initializes the BusinessLogicDatabase helper.
	 */
	public function initializeBusinessLogicDatabaseHelper() {
		return new \App\Helpers\BusinessLogicDatabase();
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
	 * Initializes the InputValidator helper.
	 */
	public function initializeInputValidatorHelper() {
		return new \App\Helpers\InputValidator();
	}
	
	/*
	 * Initializes the Parameters helper.
	 */
	public function initializeParametersHelper() {
		return new \App\Helpers\Parameters();
	}
	
	/*
	 * Initializes the Services helper.
	 */
	public function initializeServicesHelper() {
		return new \App\Helpers\Services();
	}
	
	/*
	 * Initializes the Session helper.
	 */
	public function initializeSessionHelper() {
		return new \App\Helpers\Session();
	}
	
	/*
	 * Initializes the WebServerDatabase helper.
	 */
	public function initializeWebServerDatabaseHelper() {
		return new \App\Helpers\WebServerDatabase();
	}
	
	/*
	 * Defines the helpers.
	 */
	private function defineHelpers() {
		$app = $this->app;
		
		$app->container->singleton('authentication', [ $this, 'initializeAuthenticationHelper' ]);
		$app->container->singleton('authenticator', [ $this, 'initializeAuthenticatorHelper' ]);
		$app->container->singleton('authorizationValidator', [ $this, 'initializeAuthorizationValidatorHelper' ]);
		$app->container->singleton('businessLogicDatabase', [ $this, 'initializeBusinessLogicDatabaseHelper' ]);
		$app->container->singleton('cryptography', [ $this, 'initializeCryptographyHelper' ]);
		$app->container->singleton('emailBuilder', [ $this, 'initializeEmailBuilderHelper' ]);
		$app->container->singleton('inputValidator', [ $this, 'initializeInputValidatorHelper' ]);
		$app->container->singleton('parameters', [ $this, 'initializeParametersHelper' ]);
		$app->container->singleton('services', [ $this, 'initializeServicesHelper' ]);
		$app->container->singleton('session', [ $this, 'initializeSessionHelper' ]);
		$app->container->singleton('webServerDatabase', [ $this, 'initializeWebServerDatabaseHelper' ]);
	}
	
}
