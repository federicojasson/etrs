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
	 * Creates and returns the AccessValidator helper.
	 */
	public function createAccessValidatorHelper() {
		return new \App\Helper\AccessValidator();
	}
	
	/*
	 * Creates and returns the Authentication helper.
	 */
	public function createAuthenticationHelper() {
		return new \App\Helper\Authentication();
	}
	
	/*
	 * Creates and returns the Authenticator helper.
	 */
	public function createAuthenticatorHelper() {
		return new \App\Helper\Authenticator();
	}
	
	/*
	 * Creates and returns the BusinessLogicDatabase helper.
	 */
	public function createBusinessLogicDatabaseHelper() {
		return new \App\Helper\Database\BusinessLogicDatabase();
	}
	
	/*
	 * Creates and returns the Cryptography helper.
	 */
	public function createCryptographyHelper() {
		return new \App\Helper\Cryptography();
	}
	
	/*
	 * Creates and returns the Data helper.
	 */
	public function createDataHelper() {
		return new \App\Helper\Data();
	}
	
	/*
	 * Creates and returns the Emails helper.
	 */
	public function createEmailsHelper() {
		return new \App\Helper\Emails();
	}
	
	/*
	 * Creates and returns the Files helper.
	 */
	public function createFilesHelper() {
		return new \App\Helper\Files();
	}
	
	/*
	 * Creates and returns the InputValidator helper.
	 */
	public function createInputValidatorHelper() {
		return new \App\Helper\InputValidator();
	}
	
	/*
	 * Creates and returns the Parameters helper.
	 */
	public function createParametersHelper() {
		return new \App\Helper\Parameters();
	}
	
	/*
	 * Creates and returns the Services helper.
	 */
	public function createServicesHelper() {
		return new \App\Helper\Services();
	}
	
	/*
	 * Creates and returns the Session helper.
	 */
	public function createSessionHelper() {
		return new \App\Helper\Session();
	}
	
	/*
	 * Creates and returns the WebServerDatabase helper.
	 */
	public function createWebServerDatabaseHelper() {
		return new \App\Helper\Database\WebServerDatabase();
	}
	
	/*
	 * Defines the helpers.
	 */
	private function defineHelpers() {
		$app = $this->app;
		
		// Defines the helpers
		$app->container->singleton('accessValidator', [ $this, 'createAccessValidatorHelper' ]);
		$app->container->singleton('authentication', [ $this, 'createAuthenticationHelper' ]);
		$app->container->singleton('authenticator', [ $this, 'createAuthenticatorHelper' ]);
		$app->container->singleton('businessLogicDatabase', [ $this, 'createBusinessLogicDatabaseHelper' ]);
		$app->container->singleton('cryptography', [ $this, 'createCryptographyHelper' ]);
		$app->container->singleton('data', [ $this, 'createDataHelper' ]);
		$app->container->singleton('emails', [ $this, 'createEmailsHelper' ]);
		$app->container->singleton('files', [ $this, 'createFilesHelper' ]);
		$app->container->singleton('inputValidator', [ $this, 'createInputValidatorHelper' ]);
		$app->container->singleton('parameters', [ $this, 'createParametersHelper' ]);
		$app->container->singleton('services', [ $this, 'createServicesHelper' ]);
		$app->container->singleton('session', [ $this, 'createSessionHelper' ]);
		$app->container->singleton('webServerDatabase', [ $this, 'createWebServerDatabaseHelper' ]);
	}
	
}
